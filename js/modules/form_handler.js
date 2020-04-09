/** Form handler */

import Alert from '../util/alert';

class FormHandler {
  constructor() {}

  bind(root) {
    this.ref = {};
    this.ref.zineHandler = root.modules.zineHandler;

    // override forms
    document.querySelectorAll('form').forEach(form => {
      form.onsubmit = evt => {
        evt.preventDefault();
        this.submit(form);
      };
    });
  }

  submit(form) {
    const msg = form.dataset.msg || form.action;
    console.log('[FormHandler]', form.action);
    const alert = new Alert({msg: msg, domTarget: form});
    const formData = new FormData(form);
    fetch(form.action, {method: 'POST', body: formData})
      .then(res => res.json())
      .then(json => {
        console.log(json);
        if (json.res === 'SUCCESS') {
          const alert = new Alert({msg: json.msg, domTarget: form});
          this.handle(json);
        } else if (json.res === 'ERROR') {
          const alert = new Alert({msg: json.msg, domTarget: form});
        } else if (json.res === 'REDIRECT') {
          const url = json.data;
          window.location = url;
        }
      });
  }

  handle(res) {
    if (res.msg === 'action-get-zine' && res.data !== null) {
      this.ref.zineHandler.addZine(res.data);
      document.querySelectorAll('#zine-password').forEach(el => {
        el.classList.remove('active');
      });
      document.querySelectorAll('.alert').forEach(el => {
        el.remove();
      });
    }
  }

  print(res) {
    res.text().then(text => { console.log(text); });
  }
}

export default FormHandler;
