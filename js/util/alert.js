/** Alert */

import CreateElement from './create_element';

class Alert {
  constructor(params) {
    this.msg = params.msg || null;
    this.error = params.error || null;
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

      setTimeout(() => {
        this.el.classList.add('active');
        setTimeout(() => {
          this.destroy();
        }, 2000);
      }, 50);

      document.querySelector('body').appendChild(this.el);
    }
  }
}

export default Alert;
