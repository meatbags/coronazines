/** Navigation */

import GetContainedRect from '../util/get_contained_rect';

class Navigation {
  constructor() {}

  bind(root) {
    this.ref = {};
    this.ref.zineHandler = root.modules.zineHandler;

    // collapse buttons
    document.querySelectorAll('[data-collapse]').forEach(el => {
      el.innerHTML = '<div></div><div></div>';
      el.addEventListener('click', () => {
        const target = document.querySelector(el.dataset.collapse);
        el.classList.toggle('active');
        if (target) {
          if (el.classList.contains('active')) {
            target.classList.add('collapsed');
          } else {
            target.classList.remove('collapsed');
          }
        }
      });
    });

    // mobile menu
    const button = document.querySelector('#mobile-menu-button');
    const menu = document.querySelector('#mobile-menu');
    button.addEventListener('click', () => {
      if (menu.classList.contains('active')) {
        button.classList.remove('active');
        menu.classList.remove('active');
      } else {
        button.classList.add('active');
        menu.classList.add('active');
      }
    });
    menu.querySelectorAll('item').forEach(el => {
      el.addEventListener('click', () => {
        button.classList.remove('active');
        menu.classList.remove('active');
      });
    });

    // view buttons
    document.querySelectorAll('[data-view]').forEach(el => {
      el.addEventListener('click', () => {
        this.openView(el.dataset.view);
      });
    });

    // href
    document.querySelectorAll('[data-href]').forEach(el => {
      el.addEventListener('click', () => {
        window.location = el.dataset.href;
      });
    });

    // zine list
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
    /*
    document.querySelectorAll('.placeholder').forEach(p => {
      const parent = p.parentNode.getBoundingClientRect();
      const child = {width: 1, height: 1.414};
      const rect = GetContainedRect(child, parent);
      p.style.width = `${rect.width}px`;
      p.style.height = `${rect.height}px`;
    });
    */
  }
}

export default Navigation;
