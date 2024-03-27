<script>
export default {
    props: {
        title: {
            type: String,
            default: ""
        },
        value: {
            type: String,
            default: ""
        },
        icon: {
            type: String,
            default: ""
        },
        loading: {
            type: Boolean,
            default: false
        }
    }
};
</script>

<template>
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="d-flex" v-if="!loading">
                <div class="flex-grow-1">
                    <p class="text-muted fw-medium mb-2">{{title}}</p>
                    <h4 class="mb-0">{{value}}</h4>
                </div>

                <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
          <span class="avatar-title">
            <i :class="`${icon} font-size-24`"></i>
          </span>
                </div>
            </div>
            <div class="d-flex justify-content-center" v-else>
                <BSpinner variant="primary" />
            </div>
        </div>
        <!-- end card-body -->
    </div>
    <!-- end card -->
</template>
