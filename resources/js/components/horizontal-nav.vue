<script>
import { menuItems } from "./horizontal-menu";

export default {
  data() {
    return {
      menuItems: menuItems,
    }
  },
  mounted() {
    var links = document.getElementsByClassName("side-nav-link-ref");
    var matchingMenuItem = null;
    for (var i = 0; i < links.length; i++) {
      if (window.location.pathname === links[i].pathname) {
        matchingMenuItem = links[i];
        break;
      }
    }

    if (matchingMenuItem) {
      matchingMenuItem.classList.add("active");
      var parent = matchingMenuItem.parentElement;

      /**
       * TODO: This is hard coded way of expading/activating parent menu dropdown and working till level 3.
       * We should come up with non hard coded approach
       */

      if (parent) {
        parent.classList.add("active");
        const parent2 = parent.parentElement;
        if (parent2) {
          parent2.classList.add("active");
          const parent3 = parent2.parentElement;
          if (parent3) {
            parent3.classList.add("active");
            const parent4 = parent3.parentElement;
            if (parent4) {
              parent4.classList.add("active");
              const parent5 = parent4.parentElement;
              if (parent5) {
                parent5.classList.add("active");
                const parent6 = parent5.parentElement;
                if (parent6) {
                  parent6.classList.add("active");
                }
              }
            }
          }
        }
      }
    }
  },
  methods: {
    /**
     * Returns true or false if given menu item has child or not
     * @param item menuItem
     */

    hasItems(item) {
      return item.subItems !== undefined ? item.subItems.length > 0 : false;
    },
  },
};
</script>

<template>
  <div class="topnav">
    <BContainer fluid>
      <nav class="navbar navbar-light navbar-expand-lg topnav-menu active">
        <div id="collapse navbar-collapse active" class="topnav-menu-content">
          <ul class="navbar-nav">
            <!-- Menu data -->

<!--            <template v-for="(item, index) of menuItems" :key="index">-->
<!--              <li class="nav-item dropdown">-->
<!--                <router-link class="nav-link dropdown-toggle arrow-none" v-if="!item.subItems" id="topnav-components" :to="item.link" role="button">-->
<!--                  <i :class="`bx ${item.icon} mr-2`"></i>{{ $t(item.label) }}-->
<!--                  <div class="arrow-down" v-if="hasItems(item)"></div>-->
<!--                </router-link>-->

<!--                <BLink v-if="item.subItems" class="nav-link dropdown-toggle arrow-none" id="topnav-components" role="button">-->
<!--                  <i :class="`bx ${item.icon} mr-1`"></i>-->
<!--                  {{ $t(item.label) }}-->
<!--                  <div class="arrow-down"></div>-->
<!--                </BLink>-->

<!--              </li>-->
<!--            </template>-->
          </ul>
        </div>
      </nav>
    </BContainer>
  </div>
</template>
