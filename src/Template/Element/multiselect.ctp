<?php
/**
  Creates a QuasarComponent for text-input by using the Cake FormHelper.
  It does this by appending JavaScript two script blocks.
 */


# Create the VueTemplate script block
$this->Html->scriptStart(['block' => true, 'type' => "text/x-template", 'id' => "qfh-multiselect"]);
?>
  <div>
      <q-select :value='form[name]' @input="updateForm" multiple :options="options" :name="name" :id="id" ></q-select>
      <input v-for="(option, index) in options" type="hidden" :name="getFormElementName()"  :value="form[name][index]" />
  </div>
<?php
$this->Html->scriptEnd();

# Create the VueComponent script block
$this->Html->scriptStart(['block' => true]);
?>

Vue.component('qfh-multiselect', {
  template: '#qfh-multiselect',
  props: ['id', 'name', 'value', 'options', 'formelementname'],
  created () {
    console.log('--->',this.value)
    this.$store.commit('SET_FORM_VALUE', {key: this.name, value: this.value.length ? JSON.parse(this.value) : []})
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
      },
      getFormElementName() {
        return this.formelementname+'[]';
      }
  }
})
<?php $this->Html->scriptEnd();
