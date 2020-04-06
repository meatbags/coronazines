/** Zine manager */

import Zine from './zine';

class ZineHandler {
  constructor() {
    this.zines = [];

    // get embedded zine
    const el = document.querySelector('#zine-data-target');
    if (el) {
      try {
        const data = JSON.parse(el.innerHTML);
        this.addZine(data);
      } catch(err) {
        console.log(err);
      }
    }
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

  addZine(data) {
    const zine = new Zine({
      data: data,
      domTarget: document.querySelector('#zine-target'),
    });
    this.zines.push(zine);
    zine.show();
  }

  openZine(ref) {
    // hide zines
    this.zines.forEach(zine => { zine.hide(); });

    // show zine if loaded
    const zine = this.zines.find(z => z.getRef() === ref);
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
              this.addZine(json.data);
            }
          } else {
            console.log(json);
          }
        });
    }
  }
}

export default ZineHandler;
