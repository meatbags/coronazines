/** Alert */

import CreateElement from './create_element';

class Alert {
  constructor(params) {
    this.msg = params.msg || null;
    this.error = params.error || null;
    this.domTarget = params.domTarget || null;
    this.render();
  }

  destroy() {
    if (this.el.classList.contains('active')) {
      this.el.classList.remove('active');
      setTimeout(() => {
        this.el.remove();
      }, 500);
    }
  }

  render() {
    if (!this.el) {
      const classList = 'alert' + (this.error ? ' alert--error' : '');
      this.el = CreateElement({
        class: classList,
        innerHTML: this.msg || this.error,
      });

      // remove other alerts
      document.querySelectorAll('.alert.active').forEach(el => {
        el.classList.remove('active');
      });

      // activate
      setTimeout(() => {
        // set position
        if (this.domTarget) {
          const rect = this.el.getBoundingClientRect();
          const target = this.domTarget.getBoundingClientRect();
          const x = target.left;
          const y = target.top + target.height;
          this.el.style.left = `${x}px`;
          this.el.style.top = `${y}px`;
          this.el.style.bottom = 'auto';
        }

        // activate
        this.el.classList.add('active');
        setTimeout(() => {
          this.destroy();
        }, 2000);
      }, 30);

      document.querySelector('body').appendChild(this.el);
    }
  }
}

export default Alert;
