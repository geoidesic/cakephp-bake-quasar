<?php
/**
  Creates a QuasarComponent for text-input by using the Cake FormHelper.
  It does this by appending JavaScript two script blocks.
 */


# Create the VueTemplate script block
$this->Html->scriptStart(['block' => true, 'type' => "text/x-template", 'id' => "qfh-text"]);
?>
      <q-input class="<?= $class ?>" :name="name" :id="id" :value='form[name]' @input="updateForm" :type="type"></q-input>
<?php
$this->Html->scriptEnd();

# Create the VueComponent script block
$this->Html->scriptStart(['block' => true]);
?>

Vue.component('qfh-text', {
  template: '#qfh-text',
  props: ['name', 'id', 'value', 'type'],
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
