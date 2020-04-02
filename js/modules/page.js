/** Page */

import CreateElement from '../util/create_element';
import Clamp from '../util/clamp';
import IsMobileDevice from '../util/is_mobile_device';

class Page {
  constructor(params) {
    this.root = params.root;
    this.index = params.index;
    this.domTarget = params.domTarget;
    this.front = null;
    this.back = null;
    this.flipped = false;
    this.full = false;
    this.isMobile = IsMobileDevice();
    this.mouse = {
      active: false,
      origin: {x: 0, y: 0},
      delta: {x: 0, y: 0},
      flipThreshold: 0.25,
    };
    this.rotation = 0;
    this.render();
  }

  setFront(html) {
    this.front = this.front == null ? this.el.querySelector('.page__front') : this.front;
    this.front.innerHTML = html;
    this.full = this.front && this.back;
  }

  setBack(html) {
    this.back = this.back == null ? this.el.querySelector('.page__back') : this.back;
    this.back.innerHTML = html;
    this.full = this.front && this.back;
  }

  flip(index) {
    // enable transition, disable pointer
    this.el.classList.remove('disable-transition');

    // forward
    if (this.index < index) {
      if (this.el.classList.contains('flipped') === false) {
        this.el.style.zIndex = this.root.pages.length;
        this.el.classList.add('flipped');
      } else {
        this.el.style.zIndex = this.index;
      }
      this.flipped = true;

    // back
    } else {
      if (this.el.classList.contains('flipped')) {
        this.el.style.zIndex = this.root.pages.length;
        this.el.classList.remove('flipped');
      } else {
        this.el.style.zIndex = this.root.pages.length - this.index;
      }
      this.flipped = false;
    }

    // set active/ visible pages
    this.el.classList.remove('active');
    this.el.classList.remove('visible');
    if (this.index >= index - 1 && this.index <= index) {
      this.el.classList.add('active');
    } else if (this.index >= index - 2 && this.index <= index + 1) {
      this.el.classList.add('visible');
    }
  }

  isFull() {
    return this.full;
  }

  isFlipped() {
    return this.flipped;
  }

  setRotation(deg) {
    if (this.flipped) {
      this.el.style.transform = `translate3d(0, 0, 0) rotateY(${deg}deg) scale(1.0)`;
    } else {
      this.el.style.transform = `translate3d(-1px, 0, 0) rotateY(${deg}deg) scale(1.0)`;
    }
  }

  mouseDown(evt) {
    this.size = this.root.getSize();
    this.mouse.active = true;
    this.mouse.origin.x = this.isMobile ? evt.touches[0].clientX : evt.clientX;
    this.mouse.origin.y = this.isMobile ? evt.touches[0].clientY : evt.clientY;
    this.mouse.delta.x = 0;
    this.mouse.delta.y = 0;
    this.el.style.zIndex = this.root.pages.length + 1;
    this.el.classList.add('disable-transition');
  }

  mouseMove(evt) {
    if (this.mouse.active) {
      const x = this.isMobile ? evt.touches[0].clientX : evt.clientX;
      const y = this.isMobile ? evt.touches[0].clientY : evt.clientY;
      this.mouse.delta.x = x - this.mouse.origin.x;
      this.mouse.delta.y = y - this.mouse.origin.y;
      if (this.flipped) {
        if (this.mouse.delta.x > 0) {
          const t = Clamp(this.mouse.delta.x / this.size.width, 0, 1.5);
          const rot = -180 + (t * 90);
          this.setRotation(rot);
        } else {
          this.setRotation(-180);
        }
      } else {
        if (this.mouse.delta.x < 0) {
          const t = Clamp(Math.abs(this.mouse.delta.x / this.size.width), 0, 1.5);
          const rot = t * -90;
          this.setRotation(rot);
        } else {
          this.setRotation(0);
        }
      }
    }
  }

  mouseUp() {
    if (this.mouse.active) {
      this.mouse.active = false;
      this.el.classList.remove('disable-transition');
      this.el.style.transform = '';
      if (this.flipped) {
        if (this.mouse.delta.x > 0 && this.mouse.delta.x / this.size.width > this.mouse.flipThreshold) {
          this.root.prevPage();
        }
      } else {
        if (this.mouse.delta.x < 0 && this.mouse.delta.x / this.size.width < -this.mouse.flipThreshold) {
          this.root.nextPage();
        }
      }
    }
  }

  render() {
    if (!this.el) {
      this.el = CreateElement({
        class: 'page',
        dataset: {index: this.index},
        childNodes: [
          { class: 'page__inner page__front' },
          { class: 'page__inner page__back' }
        ]
      });
      this.domTarget.appendChild(this.el);

      // bind events
      this.el.addEventListener(this.isMobile ? 'touchstart' : 'mousedown', evt => { this.mouseDown(evt); });
      window.addEventListener(this.isMobile ? 'touchmove' : 'mousemove', evt => { this.mouseMove(evt); });
      window.addEventListener(this.isMobile ? 'touchend' : 'mouseup', evt => { this.mouseUp(); });
    }
  }
}

export default Page;
