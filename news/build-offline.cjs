const fs = require('node:fs');
const path = require('node:path');
const root = path.join(__dirname, 'joongang-25469354');
const manifest = JSON.parse(fs.readFileSync(path.join(root, 'asset-manifest.json'), 'utf8'));
const available = manifest.resources.filter(r => fs.existsSync(path.join(root,r.file)) && fs.statSync(path.join(root,r.file)).size > 0);
const map = Object.fromEntries(available.map(r => [r.url, r.file]));
const missingCss = [];
fs.mkdirSync(path.join(root, 'source-css'), {recursive:true});
function rewriteCss(text, base, relativeToAsset) {
  const replace = raw => {
    if (/^(data:|blob:|#)/i.test(raw)) return raw;
    try {
      const u = new URL(raw, base), fragment = u.hash;
      u.hash = '';
      if (map[u.href]) return (relativeToAsset ? path.posix.basename(map[u.href]) : map[u.href]) + fragment;
      missingCss.push({base,url:u.href});
    } catch {}
    return 'data:,';
  };
  return text.replace(/url\(\s*(?:"([^"]*)"|'([^']*)'|([^)]*))\s*\)/gi, (_,a,b,c) => `url("${replace((a??b??c).trim())}")`)
    .replace(/(@import\s+)["']([^"']+)["']/gi, (_,prefix,url) => `${prefix}"${replace(url)}"`);
}
for (const r of available.filter(r => r.file.endsWith('.css'))) {
  const source = path.join(root, 'source-css', path.basename(r.file));
  if (!fs.existsSync(source)) fs.copyFileSync(path.join(root,r.file),source);
  fs.writeFileSync(path.join(root,r.file), rewriteCss(fs.readFileSync(source,'utf8'),r.url,true));
}
// This transformation runs in the capture browser to use its native HTML parser.
const expression = `(() => {
 const source = ${JSON.stringify(fs.readFileSync(path.join(root,'rendered-original.html'),'utf8'))};
 const map = ${JSON.stringify(map)};
 const base = ${JSON.stringify(manifest.source)};
 const doc = new DOMParser().parseFromString(source,'text/html');
 const missing = [];
 const local = raw => {
   if (!raw || /^(data:|blob:|#)/i.test(raw)) return raw;
   try {const u=new URL(raw,base),hash=u.hash;u.hash='';if(map[u.href])return map[u.href]+hash;missing.push(u.href);}catch{}
   return 'data:,';
 };
 const css = text => text.replace(/url\\(\\s*(?:"([^"]*)"|'([^']*)'|([^)]*))\\s*\\)/gi,(_,a,b,c)=>'url("'+local((a??b??c).trim())+'")');
 for(const el of doc.querySelectorAll('script')) {
   if(!['application/ld+json','application/json'].includes(el.type))el.remove();
 }
 for(const el of doc.querySelectorAll('noscript,base,meta[http-equiv="Content-Security-Policy" i],meta[http-equiv="refresh" i]'))el.remove();
 for(const el of doc.querySelectorAll('link')) {
   if(!['stylesheet','icon','shortcut icon','apple-touch-icon','canonical'].includes(el.rel)){el.remove();continue;}
   if(el.rel!=='canonical')el.setAttribute('href',local(el.getAttribute('href')));
 }
 for(const el of doc.querySelectorAll('*')) {
   for(const a of [...el.attributes])if(/^on/i.test(a.name)||['integrity','crossorigin','nonce','ping','srcdoc'].includes(a.name))el.removeAttribute(a.name);
   if(el.tagName==='IFRAME') {el.removeAttribute('src');el.setAttribute('srcdoc','<!doctype html><html><body style="margin:0;background:transparent"></body></html>');continue;}
   if(el.hasAttribute('src'))el.setAttribute('src',local(el.getAttribute('src')));
   if(el.hasAttribute('poster'))el.setAttribute('poster',local(el.getAttribute('poster')));
   if(el.tagName==='OBJECT'&&el.hasAttribute('data'))el.setAttribute('data',local(el.getAttribute('data')));
   if(el.tagName==='IMG') {el.loading='eager';el.removeAttribute('srcset');el.removeAttribute('sizes');el.removeAttribute('data-src');el.removeAttribute('data-srcset');}
   if(el.tagName==='SOURCE'&&el.hasAttribute('srcset'))el.setAttribute('srcset',el.getAttribute('srcset').split(',').map(s=>{const [u,...rest]=s.trim().split(/\\s+/);return local(u)+' '+rest.join(' ')}).join(','));
   if(el.hasAttribute('style'))el.setAttribute('style',css(el.getAttribute('style')));
   if(['A','AREA'].includes(el.tagName)&&el.hasAttribute('href')){
     const href=el.getAttribute('href');
     if(/^javascript:/i.test(href))el.setAttribute('href','#');
     else if(href&&!href.startsWith('#')){try{el.setAttribute('href',new URL(href,base).href);}catch{}}
   }
 }
 for(const el of doc.querySelectorAll('style'))el.textContent=css(el.textContent);
 doc.documentElement.setAttribute('data-offline-source',base);
 const csp=doc.createElement('meta');csp.httpEquiv='Content-Security-Policy';
 csp.content="default-src 'self' data: blob: 'unsafe-inline'; connect-src 'none'; frame-src 'self' data: about:; object-src 'none'";
 doc.head.prepend(csp);
 const runtime=doc.createElement('script');runtime.src='offline.js';doc.body.append(runtime);
 return {html:'<!doctype html>\\n'+doc.documentElement.outerHTML,missing:[...new Set(missing)]};
})()`;
fs.writeFileSync(path.join(root, 'build-expression.js'), expression);
manifest.resources = manifest.resources.map(r=>({...r,available:!!map[r.url]}));
manifest.offline = {available:available.length,missingCss,entry:'index.html',originalSnapshot:'original-page.mhtml'};
fs.writeFileSync(path.join(root, 'asset-manifest.json'), JSON.stringify(manifest,null,2));
module.exports = {available:available.length,missingCss};
