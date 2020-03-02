<!DOCTYPE html>
<html lang="en-gb">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1,width=device-width">

    <title>Quasar App - kit</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">
    <link rel="icon" href="/surge.png" type="image/x-icon">
    <?= $this->Html->css('QuasarAdmin.styles') ?>

    <style type="text/css">
      .logo-container {
        width: 255px;
        height: 242px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
      }
      .logo {
        position: absolute;
      }
    </style>
  </head>
  <body>
    <div id="q-app">
      <q-layout v-cloak view="lHh Lpr fff">
        <q-layout-header>
          <q-toolbar
            :glossy="$q.theme === 'mat'"
            :inverted="$q.theme === 'ios'"
          >
            <q-btn flat round dense @click="drawerState = !drawerState" icon="menu"></q-btn>

            <q-toolbar-title>
              Quasar App - kit
              <div slot="subtitle">Running on Quasar v{{ version }}</div>
            </q-toolbar-title>
          </q-toolbar>
        </q-layout-header>

        <?= $this->fetch('q-layout-drawer') ?>

        <q-page-container>
          <quasar-page></quasar-page>
        </q-page-container>
      </q-layout>
    </div>

    <?php
    # The content block isn't actually used because the q-page-container takes up the whole visible area on screen and it's output is defined by script tags which are output as VueJs Templates via buffers that are run in the Cake View's Template. So this line generates markup that's only visible in Source view
     // echo $this->fetch('content');

    ?>


    <script src="https://cdn.jsdelivr.net/npm/vue@latest/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuex@latest/dist/vuex.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quasar-framework@^0.17.0/dist/umd/quasar.mat.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quasar-framework@^0.17.0/dist/umd/i18n.en-us.umd.min.js"></script>

    <?= $this->fetch('vue-template'); ?>
    <?= $this->fetch('vue-component'); ?>
    <?= $this->fetch('script'); ?>

    <script>


      Quasar.i18n.set(Quasar.i18n.enGb)

      const store = new Vuex.Store({
        strict: true, // remove for production
        state: {
          message: '',
          form: {

          }
        },
        mutations: {
          SET_FORM_VALUE(state, obj) {
            console.log('SET_FORM_VALUE', obj)
            // state.form[obj.key] = obj.value
            Vue.set(state.form, obj.key,  obj.value)
            console.log(state.form)
          },
          updateMessage (state, message) {
              state.message = message
          }
        }
      })

      new Vue({
        el: '#q-app',
        store,
        data: function () {
          return {
            version: Quasar.version,
            drawerState: true
          }
        },
        created () {
          console.log(this.$store.state)
        },
        methods: {
          launch: function (url) {
            // Quasar.utils.openURL(url)
          }
        }
      })

    </script>

  </body>
</html>
