/** App */

import Navigation from './navigation';

class App {
  constructor() {
    this.modules {
      navigation: new Navigation(),
    };

    for (const key in this.modules) {
      if (typeof this.modules[key].bind === 'function') {
        this.modules[key].bind(this);
      }
    }
  }
}

window.addEventListener('load', () => {
  const app = new App();
});
