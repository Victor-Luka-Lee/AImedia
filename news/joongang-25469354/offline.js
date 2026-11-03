/* Small local interactions. Original downloaded scripts are retained in assets. */
(() => {
  const close = () => document.querySelectorAll('.layer_popup:not(.hide)').forEach(el => el.classList.add('hide'));
  const article = document.querySelector('#article_body');
  document.addEventListener('click', async event => {
    const button = event.target.closest('button,a');
    if (!button) return;
    if (button.matches('a[href="#"],a[href="#none"]')) event.preventDefault();
    if (button.matches('.btn_print')) { window.print(); return; }
    if (button.matches('.btn_top')) {window.scrollTo({top:0,behavior:'smooth'});return;}
    if (button.matches('.btn_fontsize,.btn_share')) {
      const id = button.matches('.btn_fontsize') ? 'layer_fontsize' : 'layer_share';
      const layer = document.getElementById(id);
      const wasOpen = layer && !layer.classList.contains('hide');
      close(); if (layer && !wasOpen) layer.classList.remove('hide');return;
    }
    if(button.closest('#layer_fontsize [data-size]') && article) {
      const option=button.closest('[data-size]');
      const level=Number(option.dataset.size);
      if(level>=1&&level<=5){
        article.classList.remove('fs1','fs2','fs3','fs4','fs5');article.classList.add('fs'+level);
        option.parentElement.querySelectorAll('[data-size]').forEach(el=>el.classList.toggle('active',el===option));
      }
    }
    if(button.matches('.btn_close,[aria-label="닫기"]'))close();
    if(button.closest('#layer_share') && /복사/.test(button.textContent+button.getAttribute('aria-label'))) {
      try {await navigator.clipboard.writeText('https://www.joongang.co.kr/article/25469354');}catch{}
    }
  });
  document.addEventListener('keydown',event=>{if(event.key==='Escape')close();});
  document.querySelectorAll('.btn_top').forEach(el=>{const update=()=>el.style.display=scrollY>500?'':'none';addEventListener('scroll',update,{passive:true});update();});
})();
