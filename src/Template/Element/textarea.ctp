<?php
/**
  Creates a QuasarComponent for textarea-input by using the Cake FormHelper.
  It does this by appending JavaScript two script blocks.
 */


# Create the VueTemplate script block
$this->Html->scriptStart(['block' => true, 'type' => "text/x-template", 'id' => "qfh-textarea"]);
?>
  <div>
      <q-editor class="<?= $class ?>" :name="name" :id="id" :value='form[name]' @input="updateForm"></q-editor>
      <input type="hidden" :name="name" :id="id" :value="form[name]" />
  </div>
<?php
$this->Html->scriptEnd();

# Create the VueComponent script block
$this->Html->scriptStart(['block' => true]);
?>

Vue.component('qfh-textarea', {
  template: '#qfh-textarea',
  props: ['name', 'id', 'value'],
  created () {
    this.$store.commit('SET_FORM_VALUE', {key: this.name, value: this.value})
  },
  mounted () {
  },
  computed: {
      form () {
        return this.$store.state.form
      }
  },
  methods: {
      updateForm (v) {
          this.$store.commit('SET_FORM_VALUE', {key: this.name, value: v})
      }
  }
})
<?php $this->Html->scriptEnd();
