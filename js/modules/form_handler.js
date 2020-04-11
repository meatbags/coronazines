/** Form handler */

import Alert from '../util/alert';

class FormHandler {
  constructor() {
    const el = document.querySelector('[data-session-token]');
    this.sessionToken = el ? el.dataset.sessionToken : null;
  }

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
    const alert = new Alert({msg: msg, domTarget: form});

    // create form body
    const formData = new FormData(form);
    formData.append('session_token', this.sessionToken);

    // submit async
    console.log('[FormHandler]', form.action);
    fetch(form.action, {method: 'POST', body: formData})
      .then(res => res.json())
      .then(json => { this.handle(json); });
  }

  handle(res) {
    // logs
    console.log(res);
    if (res.res === 'SUCCESS' || res.res === 'ERROR') {
      const alert = new Alert({msg: res.msg, domTarget: form});
    } else if (res.res === 'REDIRECT') {
      const url = res.data;
      window.location = url;
    }
    
    // handle specific actions
    if (res.res === 'SUCCESS' && res.msg === 'action-get-zine' && res.data !== null) {
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
