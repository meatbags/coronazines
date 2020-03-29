/** Navigation */

import GetContainedRect from '../util/get_contained_rect';

class Navigation {
  constructor() {}

  bind(root) {
    this.ref = {};
    this.ref.zineHandler = root.modules.zineHandler;

    // bind views
    document.querySelectorAll('[data-view]').forEach(el => {
      el.addEventListener('click', () => {
        this.openView(el.dataset.view);
      });
    });

    // bind zine list
    document.querySelectorAll('[data-zine]').forEach(el => {
      el.addEventListener('click', () => {
        this.openZine(el.dataset.zine);
      });
    });

    // load zine from window
    const search = new URLSearchParams(window.location.search);
    if (search.has('ref')) {
      const ref = search.get('ref');
    }
  }

  openView(selector) {
    const target = document.querySelector(selector);
    document.querySelectorAll('.view.active').forEach(el => {
      el.classList.remove('active');
    });
    if (target) {
      target.classList.add('active');
    }
  }

  openZine(ref) {
    this.ref.zineHandler.openZine(ref);
  }

  resize() {
    document.querySelectorAll('.placeholder').forEach(p => {
      const parent = p.parentNode.getBoundingClientRect();
      const child = {width: 1, height: 1.414};
      const rect = GetContainedRect(child, parent);
      p.style.width = `${rect.width}px`;
      p.style.height = `${rect.height}px`;
    });
  }
}

export default Navigation;
