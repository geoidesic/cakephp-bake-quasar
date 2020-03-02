<?php
/**
  Creates a QuasarComponent for button-input by using the Cake FormHelper.
  It does this by appending JavaScript two script blocks.
 */


# Create the VueTemplate script block
$this->Html->scriptStart(['block' => true, 'type' => "text/x-template", 'id' => "qfh-button"]);
?>
      <q-btn class="<?= $class ?>" :value='form[name]' :label="label"></q-btn>
<?php
$this->Html->scriptEnd();

# Create the VueComponent script block
$this->Html->scriptStart(['block' => true]);
?>

Vue.component('qfh-button', {
  template: '#qfh-button',
  props: ['name', 'id', 'label'],
  created () {
  },
  mounted () {
    //this.formElement = window.document.getElementById('quasarform')
    //const inputs = this.formElement.getElementsByTagName('input')
  },
  computed: {
      form () {
        return this.$store.state.form
      }
  },
  methods: {
      submitForm (v) {
        //this.formElement.submit()
      }
  }
})
<?php $this->Html->scriptEnd();
