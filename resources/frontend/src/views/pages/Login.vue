<template>
    <div class="c-app flex-row align-items-center">
        <CContainer>
            <CRow class="justify-content-center">
                <CCol md="8">
                    <CCardGroup>
                        <CCard class="p-4">
                            <CCardBody>
                                <CForm @submit.prevent="login">
                                    <h1>Login</h1>
                                    <p class="text-muted">Sign In to your account</p>
                                    <CInput v-model="credentials.email"
                                            autofocus
                                            type="email"
                                            placeholder="Email"
                                            autocomplete="username email"
                                            required>
                                        <template #prepend-content>
                                            <CIcon name="cil-user"/>
                                        </template>
                                    </CInput>
                                    <CInput v-model="credentials.password"
                                            placeholder="Password"
                                            type="password"
                                            required>
                                        <template #prepend-content>
                                            <CIcon name="cil-lock-locked"/>
                                        </template>
                                    </CInput>
                                    <CRow>
                                        <CCol col="6" class="text-left">
                                            <CButton type="submit" color="primary"
                                                     :disabled="loading"
                                                     class="px-4">{{ loading ? 'Loading...' : 'Login' }}
                                            </CButton>
                                        </CCol>
                                        <CCol col="6" class="text-right">
                                            <CButton color="link" class="px-0">Forgot password?</CButton>
                                            <CButton color="link" class="d-lg-none">Register now!</CButton>
                                        </CCol>
                                    </CRow>
                                </CForm>
                            </CCardBody>
                        </CCard>
                        <CCard
                            color="primary"
                            text-color="white"
                            class="text-center py-5 d-md-down-none"
                            body-wrapper
                        >
                            <!--              <CCardBody>-->
                            <!--                <h2>Sign up</h2>-->
                            <!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
                            <!--                <CButton-->
                            <!--                    color="light"-->
                            <!--                    variant="outline"-->
                            <!--                    size="lg"-->
                            <!--                >-->
                            <!--                  Register Now!-->
                            <!--                </CButton>-->
                            <!--              </CCardBody>-->
                        </CCard>
                    </CCardGroup>
                </CCol>
            </CRow>
        </CContainer>
    </div>
</template>

<script>
import api from "@/api"
import client from "@/client"
import endpoints from "@/endpoints"

export default {
    name: 'Login',
    data() {
        return {
            loading: false,
            credentials: {
                email: null,
                password: null
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        api.isLogin()
            .then(() => next({name: 'Dashboard'}))
            .catch(() => next())
    },
    methods: {
        login() {
            this.loading = true
            api.login(this.credentials)
                .then(() => {
                    this.$router.push({name: 'Dashboard'})
                    client.get(endpoints.user)
                        .then(({data}) => this.$store.commit('setUser', data))
                        .catch(error => console.log(error))

                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>
