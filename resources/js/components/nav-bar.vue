
<script>

import simplebar from "simplebar-vue";
import us from '../../images/flags/us.jpg';
import fr from '../../images/flags/french.jpg';
import es from '../../images/flags/spain.jpg';
import zh from '../../images/flags/chaina.png';
import ar from '../../images/flags/arabic.png';

import logoDarkLg from '../../images/logo/kdt-white.png';
import logoDarkSm from '../../images/logo/kdt-small-white.png';
import logoLightLg from '../../images/logo-light.png';
import logoLightSm from '../../images/logo-light.svg';

import avatar1 from '../../images/users/avatar-1.jpg';
import avatar3 from '../../images/users/avatar-3.jpg';
import avatar4 from '../../images/users/avatar-4.jpg';

import github from '../../images/brands/github.png';
import bitbucket from '../../images/brands/bitbucket.png';
import dribbble from '../../images/brands/dribbble.png';
import dropbox from '../../images/brands/dropbox.png';
import mail_chimp from '../../images/brands/mail_chimp.png';
import slack from '../../images/brands/slack.png';

import megamenu from '../../images/megamenu-img.png';

/**
 * Nav-bar Component
 */
export default {
  data() {
    return {
      logoDarkLg, logoDarkSm, logoLightLg, logoLightSm, avatar1, avatar3, avatar4, github, bitbucket, dribbble, dropbox, mail_chimp, slack, megamenu,
      languages: [
        {
          flag: us,
          language: "en",
          title: "English",
        },
        {
          flag: fr,
          language: "fr",
          title: "French",
        },
        {
          flag: es,
          language: "es",
          title: "Spanish",
        },
        {
          flag: zh,
          language: "zh",
          title: "Chinese",
        },
        {
          flag: ar,
          language: "ar",
          title: "Arabic",
        },
      ],
      lan: this.$i18n.locale,
      text: null,
      flag: null,
      value: null,
    };
  },
  components: { simplebar },
  mounted() {
    this.value = this.languages.find((x) => x.language === this.$i18n.locale);
    this.text = this.value.title;
    this.flag = this.value.flag;
  },
  methods: {
    logout() {
      localStorage.clear();
      this.$router.push({ name: 'login' });
    },
    toggleMenu() {
      this.$parent.toggleMenu();
    },
    toggleRightSidebar() {
      this.$parent.toggleRightSidebar();
    },
    initFullScreen() {
      document.body.classList.toggle("fullscreen-enable");
      if (
        !document.fullscreenElement &&
        /* alternative standard method */ !document.mozFullScreenElement &&
        !document.webkitFullscreenElement
      ) {
        // current working methods
        if (document.documentElement.requestFullscreen) {
          document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
          document.documentElement.webkitRequestFullscreen(
            Element.ALLOW_KEYBOARD_INPUT
          );
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        }
      }
    },
    setLanguage(locale, country, flag) {
      this.lan = locale;
      this.text = country;
      this.flag = flag;
      this.$i18n.locale = locale;
      localStorage.setItem("locale", locale);
    },
  },
};
</script>

<template>
  <header id="page-topbar">
    <div class="navbar-header">
      <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
          <router-link to="/" class="logo logo-light ">
            <span class="logo-sm">
<!--              <img :src="logoDarkSm" alt height="22" />-->
            </span>
            <span class="logo-lg">
<!--              <img :src="logoDarkLg" alt height="40" />-->
            </span>
          </router-link>

        </div>

        <BButton variant="white" id="vertical-menu-btn" type="button" class=" lg:mt-5 lg:pt-5 btn btn-sm px-3 font-size-16 header-item" @click="toggleMenu">
          <i class="fa fa-fw fa-bars"></i>
        </BButton>

        <!-- App Search-->
       </div>

      <div class="d-flex">
        <BDropdown right variant="black" toggle-class="header-item" menu-class="dropdown-menu-end">
          <template v-slot:button-content>
            <img class="rounded-circle header-profile-user" :src="avatar1" alt="Header Avatar" />
            <span class="d-none d-xl-inline-block ms-1">{{ $t('navbar.dropdown.henry.text') }}</span>
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
          </template>
          <!-- item-->

          <BDropdownItem>
            <router-link to="/contacts/profile">
              <i class="bx bx-user font-size-16 align-middle me-1"></i>
              {{ $t('navbar.dropdown.henry.list.profile') }}
            </router-link>
          </BDropdownItem>
          <BDropdownItem href="javascript: void(0);">
            <i class="bx bx-wallet font-size-16 align-middle me-1"></i>
            {{ $t('navbar.dropdown.henry.list.mywallet') }}
          </BDropdownItem>
          <BDropdownItem class="d-block" href="javascript: void(0);">
            <span class="badge bg-success float-end">11</span>
            <i class="bx bx-wrench font-size-16 align-middle me-1"></i>
            {{ $t('navbar.dropdown.henry.list.settings') }}
          </BDropdownItem>
          <BDropdownItem href="javascript: void(0);">
            <i class="bx bx-lock-open font-size-16 align-middle me-1"></i>
            {{ $t('navbar.dropdown.henry.list.lockscreen') }}
          </BDropdownItem>
          <BDropdownDivider></BDropdownDivider>
          <BLink href="javascript:void(0)" @click="logout()" class="dropdown-item text-danger">
            <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
            {{ $t('navbar.dropdown.henry.list.logout') }}
          </BLink>
        </BDropdown>
      </div>
    </div>
  </header>
</template>
