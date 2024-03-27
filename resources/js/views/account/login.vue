<script>
import profileImg from '../../../images/profile-img.png';
import logo from '../../../images/logo_zaj.png';
import axios from 'axios';

/**
 * Login component
 */
export default {
    data() {
        return {
            auth: {
                username: "",
                password: ""
            },
            profileImg, logo,
            processing: false,
            authError: null,
            isAuthError: false,
        }
    },
    beforeCreate() {
        if (localStorage.getItem('user')) {
            this.$router.push('/');
        }
    },
    computed: {
        $csrfToken() {
            return document.head.querySelector('meta[name="csrf-token"]').content;
        },
    },

    methods: {
        async login() {
            this.processing = true;
            this.auth._token = this.$csrfToken;

            try {
                const response = await axios.post('/api/login', this.auth);
                const data = response.data;

                if (data.success) {
                    const logged_user = {
                        login: true,
                        user_id: data.data.id,
                        name: data.data.name,
                        username: data.data.username,
                        token: data.data.token,
                    };

                    localStorage.setItem('user', JSON.stringify(logged_user));
                    this.$router.push('/');
                } else {
                    // Handle unsuccessful login
                    this.authError = data.message || 'An error occurred during login.';
                    this.isAuthError = true;
                }
            } catch (error) {
                // Handle network or other errors
                console.error('Login error:', error.response ? error.response.data : error.message);
            } finally {
                this.processing = false;
            }
        },
    }

};
</script>

<template>
    <div class="account-pages my-5 pt-5">
        <BContainer>
            <BRow class="justify-content-center">
                <BCol lg="6" md="8" xl="5">
                    <BCard class="overflow-hidden" no-body>
                        <div class="bg-primary-subtle">
                            <BRow>
                                <BCol cols="7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcomes Back !</h5>
                                        <p>Sign in to continue to Skote.</p>
                                    </div>
                                </BCol>
                                <BCol class="align-self-end" cols="5">
                                    <img :src="logo" alt class="img-fluid"/>
                                </BCol>
                            </BRow>
                        </div>
                        <BCardBody class="pt-0">
                            <div>
                                <router-link to="/">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                          <img :src="logo" alt height="34"/>
                                        </span>
                                    </div>
                                </router-link>
                            </div>

                            <BAlert v-model="isAuthError" class="mt-3" dismissible variant="danger">{{
                                    authError
                                }}
                            </BAlert>

                            <BForm action="javascript:void(0)" class="p-2" method="POST">
                                <slot/>
                                <BFormGroup id="input-group-1" class="mb-3" label="Username" label-for="input-1">
                                    <BFormInput id="input-1" v-model="auth.username" name="username"
                                                placeholder="Enter Username"
                                                type="text"></BFormInput>
                                </BFormGroup>

                                <BFormGroup id="input-group-2" class="mb-3" label="Password" label-for="input-2">
                                    <BFormInput id="input-2" v-model="auth.password" name="password"
                                                placeholder="Enter password"
                                                type="password"></BFormInput>
                                </BFormGroup>
                                <BFormCheckbox id="customControlInline" name="checkbox-1" unchecked-value="not_accepted"
                                               value="accepted">
                                    Remember me
                                </BFormCheckbox>
                                <input type="hidden" name="_token" :value="$csrfToken">
                                <div class="mt-3 d-grid">
                                    <BButton :disabled="processing" ariant="primary" class="btn-block" type="submit"
                                             @click="login">
                                        {{ processing ? "Please wait" : "Login" }}
                                    </BButton>
                                </div>
                                <div class="mt-4 text-center">
                                    <h5 class="font-size-14 mb-3">Sign in with</h5>

                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <BLink class="social-list-item bg-primary text-white border-primary"
                                                   href="javascript: void(0);">
                                                <i class="mdi mdi-facebook"></i>
                                            </BLink>
                                        </li>
                                        <li class="list-inline-item">
                                            <BLink class="social-list-item bg-info text-white border-info"
                                                   href="javascript: void(0);">
                                                <i class="mdi mdi-twitter"></i>
                                            </BLink>
                                        </li>
                                        <li class="list-inline-item">
                                            <BLink class="social-list-item bg-danger text-white border-danger"
                                                   href="javascript: void(0);">
                                                <i class="mdi mdi-google"></i>
                                            </BLink>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-4 text-center">
                                    <router-link class="text-muted" to="/forget-password">
                                        <i class="mdi mdi-lock mr-1"></i> Forgot your password?
                                    </router-link>
                                </div>
                            </BForm>
                        </BCardBody>
                    </BCard>

                    <div class="mt-5 text-center">
                        <p>
                            Don't have an account ?
                            <router-link class="fw-medium text-primary" to="/auth/register">Signup now</router-link>
                        </p>
                        <p>
                            © {{ new Date().getFullYear() }} Skote. Crafted with
                            <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p>
                    </div>
                </BCol>
            </BRow>
        </BContainer>
    </div>
</template>

