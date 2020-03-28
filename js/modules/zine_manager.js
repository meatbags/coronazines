/** Zine manager */

import Zine from './zine';

class ZineManager {
  constructor() {
    this.zines = [];
  }

  resize() {
    this.zines.forEach(zine => {
      zine.resize();
    });
  }

  bind() {
    const pages = [];
    const data = document.querySelector('#data-target');
    data.querySelectorAll('.page').forEach(el => {
      pages.push(el.innerHTML);
    });
    const zine = new Zine({
      title: data.dataset.title,
      pages: pages
    });
    zine.show();
    this.zines.push(zine);
  }
}

export default ZineManager;
