/** Form handler */

import Alert from '../util/alert';

class FormHandler {
  constructor() {}

  bind(root) {
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
    const alert = new Alert({msg: msg});
    const formData = new FormData(form);
    fetch(form.action, {method: 'POST', body: formData})
      .then(res => res.json())
      .then(json => {
        console.log(json);
        if (json.res === 'SUCCESS') {
          const alert = new Alert({msg: json.msg, domTarget: form});
        } else if (json.res === 'ERROR') {
          const alert = new Alert({msg: json.msg, domTarget: form});
        } else if (json.res === 'REDIRECT') {
          const url = json.data;
          window.location = url;
        }
      });
  }
}

export default FormHandler;
