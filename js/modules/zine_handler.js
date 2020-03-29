/** Zine manager */

import Zine from './zine';

class ZineHandler {
  constructor() {
    this.zines = [];
    this.render();
  }

  resize() {
    this.zines.forEach(zine => {
      zine.resize();
    });
  }

  bind(root) {
    this.ref = {};
    this.ref.navigation = root.modules.navigation;
  }

  openZine(ref) {
    // hide zines
    this.zines.forEach(zine => { zine.hide(); });

    // show zine if loaded
    const zine = this.zines.find(z => z.data.zine_ref === ref);
    if (zine) {
      zine.show();

    // request zine data
    } else {
      console.log('[Navigation] fetching zine:', ref);

      // form
      const formData = new FormData();
      formData.append('ref', ref);

      // get zine
      fetch('inc/action-get-zine.php', {method: 'POST', body: formData})
        .then(res => res.json())
        .then(json => {
          if (json.res === 'SUCCESS') {
            if (json.data !== null) {
              const zine = new Zine({
                data: json.data,
                domTarget: document.querySelector('#zine-target'),
              });
              this.zines.push(zine);
              zine.show();
            }
          } else {
            console.log(json);
          }
        });
    }

    // show viewer
    this.ref.navigation.openView('#view-viewer');
  }

  render() {
    const data = document.querySelector('#data-target');
    if (!data) {
      return;
    }

    // create zine
    const title = data.dataset.title;
    const content = data.dataset.content.split(';').map(src => `<img src='${src}'>`);
    const zine = new Zine({
      title: title,
      pages: content,
      domTarget: document.querySelector('#zine-target'),
    });

    // init
    this.zines.push(zine);
    zine.show();
  }
}

export default ZineHandler;
