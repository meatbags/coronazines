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
    console.log('[FormHandler]', form.action);
    const alert = new Alert({msg: form.action});
    const formData = new FormData(form);
    fetch(form.action, {method: 'POST', body: formData})
      .then(res => res.json())
      .then(json => {
        console.log(json);
      });
  }
}

export default FormHandler;
