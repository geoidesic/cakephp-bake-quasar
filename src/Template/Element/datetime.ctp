<?php
/**
  Creates a QuasarComponent for datetime-input by using the Cake FormHelper.
  It does this by appending JavaScript two script blocks.
 */


# Create the VueTemplate script block
$this->Html->scriptStart(['block' => true, 'type' => "text/x-template", 'id' => "qfh-datetime"]);
?>
    <div>
      <q-datetime class="<?= $class ?>" :value='form[name]' @input="updateForm" :options="options" :name="name" :id="id"  ></q-datetime>
      <input type="hidden" :name="name" :id="id" :value="form[name]" />
    </div>
<?php
$this->Html->scriptEnd();

# Create the VueComponent script block
$this->Html->scriptStart(['block' => true]);
?>

Vue.component('qfh-datetime', {
  template: '#qfh-datetime',
  props: ['id', 'name', 'value', 'options'],
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
          this.$store.commit('SET_FORM_VALUE', {key: this.name, value: moment(v).format('YYYY-MM-DD HH:mm:ss')})
      }
  }
})
<?php $this->Html->scriptEnd();
