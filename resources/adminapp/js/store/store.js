import Vue from 'vue'
import Vuex from 'vuex'

import Alert from './modules/alert'
import I18NStore from './modules/i18n'

import PermissionsIndex from './cruds/Permissions'
import PermissionsSingle from './cruds/Permissions/single'
import RolesIndex from './cruds/Roles'
import RolesSingle from './cruds/Roles/single'
import UsersIndex from './cruds/Users'
import UsersSingle from './cruds/Users/single'
import ChanelsIndex from './cruds/Chanels'
import ChanelsSingle from './cruds/Chanels/single'
import MessagesIndex from './cruds/Messages'
import MessagesSingle from './cruds/Messages/single'
import TagsIndex from './cruds/Tags'
import TagsSingle from './cruds/Tags/single'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    Alert,
    I18NStore,
    PermissionsIndex,
    PermissionsSingle,
    RolesIndex,
    RolesSingle,
    UsersIndex,
    UsersSingle,
    ChanelsIndex,
    ChanelsSingle,
    MessagesIndex,
    MessagesSingle,
    TagsIndex,
    TagsSingle
  },
  strict: debug
})
