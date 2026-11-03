// Asset inventory for the offline snapshot. Run in a Node.js environment.
const fs = require('node:fs');
const path = require('node:path');
const crypto = require('node:crypto');
const root = path.join(__dirname, 'joongang-25469354');
const pageUrl = 'https://www.joongang.co.kr/article/25469354';
const records = JSON.parse(fs.readFileSync(path.join(root, 'captured-resources.json'), 'utf8'));
const existingPath = path.join(root, 'asset-manifest.json');
const known = new Map((fs.existsSync(existingPath) ? JSON.parse(fs.readFileSync(existingPath, 'utf8')).resources : records).map(r => [r.url, r]));
const decode = s => s.replace(/&amp;/g, '&').replace(/&#38;/g, '&').replace(/&quot;/g, '"');
function add(raw, base, kind = '') {
  raw = decode(raw.trim());
  if (!raw || /^(data:|blob:|javascript:|about:|#)/i.test(raw)) return;
  let url;
  try { url = new URL(raw, base); } catch { return; }
  if (!/^https?:$/.test(url.protocol)) return;
  url.hash = '';
  const key = url.href;
  if (known.has(key)) return;
  let ext = path.extname(url.pathname);
  if (!/^\.[a-z\d]{1,7}$/i.test(ext)) ext = kind === 'script' ? '.js' : '.bin';
  const file = `assets/${crypto.createHash('sha256').update(key).digest('hex').slice(0, 16)}${ext}`;
  known.set(key, { url: key, file, type: kind, status: 'pending' });
}
function cssUrls(text, base) {
  for (const m of text.matchAll(/url\(\s*(?:"([^"]*)"|'([^']*)'|([^)]*))\s*\)/gi)) add(m[1] ?? m[2] ?? m[3], base, 'css-dependency');
  for (const m of text.matchAll(/@import\s+["']([^"']+)["']/gi)) add(m[1], base, 'Stylesheet');
}
for (const name of ['rendered-original.html', 'original-source.html']) {
  if (!fs.existsSync(path.join(root, name))) continue;
  const text = fs.readFileSync(path.join(root, name), 'utf8');
  for (const m of text.matchAll(/<(img|script|link|source|video|audio|embed|object)\b[^>]*>/gi)) {
    const tag = m[0];
    if (m[1].toLowerCase() === 'link' && !/\brel\s*=\s*["'](?:stylesheet|preload|icon|shortcut icon|apple-touch-icon|manifest)["']/i.test(tag)) continue;
    for (const a of tag.matchAll(/\b(?:src|href|poster|data-src|data-original)\s*=\s*["']([^"']+)["']/gi)) add(a[1], pageUrl, m[1].toLowerCase());
    for (const a of tag.matchAll(/\b(?:srcset|data-srcset)\s*=\s*["']([^"']+)["']/gi)) for (const candidate of a[1].split(',')) add(candidate.trim().split(/\s+/)[0], pageUrl, 'image');
  }
  for (const m of text.matchAll(/<style\b[^>]*>([\s\S]*?)<\/style>/gi)) cssUrls(m[1], pageUrl);
  for (const m of text.matchAll(/\bstyle\s*=\s*"([^"]*)"/gi)) cssUrls(decode(m[1]), pageUrl);
}
for (const entry of [...known.values()]) {
  const local = path.join(root, entry.file);
  if (!fs.existsSync(local) || !fs.statSync(local).size) continue;
  entry.bytes = fs.statSync(local).size;
  if (entry.status === 'pending') entry.status = 200;
  if (entry.file.endsWith('.css')) cssUrls(fs.readFileSync(local, 'utf8'), entry.url);
  if (entry.file.endsWith('.webmanifest')) {
    try { for (const icon of JSON.parse(fs.readFileSync(local, 'utf8')).icons || []) add(icon.src, entry.url, 'image'); } catch {}
  }
}
const pending = [...known.values()].filter(r => !fs.existsSync(path.join(root, r.file)) || !fs.statSync(path.join(root, r.file)).size);
const quote = s => '"' + s.replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '"';
const config = pending.map(r => `url = ${quote(r.url)}\noutput = ${quote(path.join(root, r.file).replace(/\\/g, '/'))}\n`).join('\n');
fs.writeFileSync(path.join(root, 'download-assets.curl'), config);
fs.writeFileSync(existingPath, JSON.stringify({source:pageUrl, capturedAt:new Date().toISOString(), resources:[...known.values()]}, null, 2));
module.exports = {total: known.size, pending: pending.length, pendingByHost:pending.reduce((a,r)=>(a[new URL(r.url).hostname]=(a[new URL(r.url).hostname]||0)+1,a),{})};
