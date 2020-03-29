/** App */

import Navigation from './modules/navigation';
import ZineHandler from './modules/zine_handler';

class App {
  constructor() {
    this.modules = {
      navigation: new Navigation(),
      zineHandler: new ZineHandler(),
    };

    // bind
    for (const key in this.modules) {
      if (typeof this.modules[key].bind === 'function') {
        this.modules[key].bind(this);
      }
    }

    // resize
    this.resize();

    // bind events
    window.addEventListener('resize', () => { this.resize(); });
    window.addEventListener('orientationchange', () => {
      setTimeout(() => {
        this.resize();
      }, 250);
    });
  }

  resize() {
    for (const key in this.modules) {
      if (typeof this.modules[key].resize === 'function') {
        this.modules[key].resize();
      }
    }
  }
}

window.addEventListener('load', () => {
  const app = new App();
});
