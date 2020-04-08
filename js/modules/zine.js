/** Zine */

import CreateElement from '../util/create_element';
import GetContainedRect from '../util/get_contained_rect';
import Clamp from '../util/clamp';
import ZinePage from './zine_page';

class Zine {
  constructor(params) {
    this.data = {
      zine_ref: params.data.zine_ref,
      zine_title: params.data.zine_title,
      zine_author: params.data.zine_author,
      zine_description: params.data.zine_description,
      zine_content: params.data.zine_content,
    };
    this.domTarget = params.domTarget;

    // init
    this.index = 0;
    const sources = this.data.zine_content.split(';');
    this.pageContent = sources.map(src => (src ? `<img src='${src}'>` : ''));
    this.pages = [];
    this.width = 0;
    this.height = 0;
    this.render();
  }

  show() {
    this.resize();
    this.el.classList.add('active');
  }

  hide() {
    this.el.classList.remove('active');
  }

  prevPage() {
    this.goToIndex(this.index - 1);
  }

  nextPage() {
    this.goToIndex(this.index + 1);
  }

  goToIndex(index) {
    this.index = Clamp(index, 0, this.pages.length);

    // flip pages, set z-index
    let flipped = 0;
    this.pages.forEach(p => {
      p.flip(index);
      flipped += p.isFlipped() ? 1 : 0;
    });

    // set flags
    this.el.dataset.index = this.index;
    this.el.dataset.position = flipped == 0 ? 'first'
      : flipped == this.pages.length ? 'last'
      : null;

    // log
    console.log('[Zine] index:', this.index);
  }

  addPage(content) {
    const index = this.pages.length;
    let p = index == 0 ? null : this.pages[index - 1];

    // create new page
    if (p == null || p.isFull()) {
      const p = new ZinePage({
        root: this,
        domTarget: this.el.querySelector('.zine__page-list'),
        index: index,
      });
      p.setFront(content);
      this.pages.push(p);

    // add to existing page
    } else {
      p.setBack(content);
    }
  }

  resize() {
    const parent = this.el.getBoundingClientRect();
    if (parent.width && parent.height) {
      const ratio = {width: Math.sqrt(2), height: 1};
      const rect = GetContainedRect(ratio, parent);
      const target = this.el.querySelector('.zine__inner');
      const scale = 0.65;
      this.width = rect.width / 2 * scale;
      this.height = rect.height * scale;
      target.style.width = `${this.width}px`;
      target.style.height = `${this.height}px`;
    }
  }

  getRef() {
    return this.data.zine_ref;
  }

  getSize() {
    return {width: this.width, height: this.height};
  }

  render() {
    if (!this.el) {
      this.el = CreateElement({
        class: 'zine',
        dataset: {index: 0},
        childNodes: [{
          class: 'zine__inner',
          childNodes: [{
            class: 'zine__page-list',
          },{
            class: 'zine__controls',
            childNodes: [{
              class: 'zine__prev',
              innerHTML: '<div></div>',
              addEventListener: {
                click: () => {
                  this.prevPage();
                }
              }
            }, {
              class: 'zine__next',
              innerHTML: '<div></div>',
              addEventListener: {
                click: () => {
                  this.nextPage();
                }
              }
            }]
          }]
        }]
      });

      // add pages
      this.pageContent.forEach(content => {
        this.addPage(content);
      });

      this.domTarget.appendChild(this.el);
      this.goToIndex(this.index);

      // show
      setTimeout(() => {
        this.show();
      }, 50);
    }
  }
}

export default Zine;
