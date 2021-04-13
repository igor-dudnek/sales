<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">edit</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.edit') }}
                <strong>{{ $t('cruds.message.title_singular') }}</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.chanel_id !== null,
                      'is-focused': activeField == 'chanel'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.message.fields.chanel')
                    }}</label>
                    <v-select
                      name="chanel"
                      label="chanelurl"
                      :key="'chanel-field'"
                      :value="entry.chanel_id"
                      :options="lists.chanel"
                      :reduce="entry => entry.id"
                      @input="updateChanel"
                      @search.focus="focusField('chanel')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.title,
                      'is-focused': activeField == 'title'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.message.fields.title')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.title"
                      @input="updateTitle"
                      @focus="focusField('title')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.text,
                      'is-focused': activeField == 'text'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.message.fields.text')
                    }}</label>
                    <textarea
                      class="form-control"
                      rows="5"
                      :value="entry.text"
                      @input="updateText"
                      @focus="focusField('text')"
                      @blur="clearFocus"
                      required
                    ></textarea>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.contactt,
                      'is-focused': activeField == 'contactt'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.message.fields.contactt')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.contactt"
                      @input="updateContactt"
                      @focus="focusField('contactt')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.contacts,
                      'is-focused': activeField == 'contacts'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.message.fields.contacts')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.contacts"
                      @input="updateContacts"
                      @focus="focusField('contacts')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.tag.length !== 0,
                      'is-focused': activeField == 'tag'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.message.fields.tag')
                    }}</label>
                    <v-select
                      name="tag"
                      label="tag"
                      :key="'tag-field'"
                      :value="entry.tag"
                      :options="lists.tag"
                      :closeOnSelect="false"
                      multiple
                      @input="updateTag"
                      @search.focus="focusField('tag')"
                      @search.blur="clearFocus"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                {{ $t('global.save') }}
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  data() {
    return {
      status: '',
      activeField: ''
    }
  },
  computed: {
    ...mapGetters('MessagesSingle', ['entry', 'loading', 'lists'])
  },
  beforeDestroy() {
    this.resetState()
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchEditData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('MessagesSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setChanel',
      'setTitle',
      'setText',
      'setContactt',
      'setContacts',
      'setTag'
    ]),
    updateChanel(value) {
      this.setChanel(value)
    },
    updateTitle(e) {
      this.setTitle(e.target.value)
    },
    updateText(e) {
      this.setText(e.target.value)
    },
    updateContactt(e) {
      this.setContactt(e.target.value)
    },
    updateContacts(e) {
      this.setContacts(e.target.value)
    },
    updateTag(value) {
      this.setTag(value)
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'messages.index' })
          this.$eventHub.$emit('update-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
