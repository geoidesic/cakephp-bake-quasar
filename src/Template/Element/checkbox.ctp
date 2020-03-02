<?php
/**
  Creates a QuasarComponent for text-input by using the Cake FormHelper.
  It does this by appending JavaScript two script blocks.
 */


# Create the VueTemplate script block
// $this->Html->scriptStart(['block' => true, 'type' => "text/x-template", 'id' => "qfh-checkbox"]);
?>
  <!-- <div>
    <q-checkbox 
      :value="form[name]" 
      :val="val" @input="updateForm"
      :id="id"
      stack-label
    ></q-checkbox>
    <input type="hidden" :name="name" :id="id" :value="form[name]" />
  </div> -->
<?php
// $this->Html->scriptEnd();
$this->Html->scriptStart(['block' => true, 'type' => "text/x-template", 'id' => "qfh-checkbox"]);
?>

    <q-checkbox 
      v-model="checkbox_model"
      :val="checked" @input="updateForm"
      :id="id"
    ><input type="hidden" :name="name" :id="id" :value="form[name]" /></q-checkbox>
    

<?php
$this->Html->scriptEnd();

# Create the VueComponent script block
$this->Html->scriptStart(['block' => true]);
?>

Vue.component('qfh-checkbox', {
  template: '#qfh-checkbox',
  props: ['name', 'checked', 'id'],
  data() {
    return {
      checkbox_model: false
    }
  },
  created () {
    console.log(!!this.checked);
    this.$store.commit('SET_FORM_VALUE', {key: this.name, value: !!this.checked ? 1 : 0})
    this.checkbox_model = !!this.checked
  },
  mounted () {
    console.log(this.$store.state.form);
  },
  computed: {
      form () {
        return this.$store.state.form
      }
  },
  methods: {
      updateForm (v) {
        console.log(v);
          this.$store.commit('SET_FORM_VALUE', {key: this.name, value: v ? 1 : 0})
          this.checkbox_model = !!v
      }
  }
})
<?php $this->Html->scriptEnd();
