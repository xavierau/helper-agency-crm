<template>
    <div class="ApplicantShow">
        <CCard v-if="isLoading === false">
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h4 class="m-0">{{ workflow.label }} <small>({{ workflow.code }})</small></h4>
            </CCardHeader>
            <CCardBody>

                <section class="graph-container">
                    <workflow-diagram :workflow="workflow"
                                      style="height: 300px"/>
                </section>

                <section>
                    <h5>Transitions
                        <button @click="showCreateTransitionModal = true" class="btn-success btn btn-icon btn-sm">
                            <i class="fa fa-plus"></i></button>
                    </h5>
                    <CDataTable
                        :items="workflow.transitions"
                        :fields="['label','code', {
                            key:'from_state.label',
                            label:'From State'
                        },{
                            key:'to_state.label',
                            label:'to State'
                        },
                        'actions']"
                        :loading="isLoading"
                        hover
                        :items-per-page="15"
                        column-filter
                        table-filter
                        sorter>
                        <template #from_state.label="{item}">
                            <td>{{ item.from_state.label }}</td>
                        </template>
                        <template #to_state.label="{item}">
                            <td>{{ item.to_state.label }}</td>
                        </template>
                        <template #actions="{item}">
                            <td>
                                <button @click="deleteTransition(item)"
                                        class="btn btn-sm btn-icon btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </template>
                    </CDataTable>
                    <hr>
                </section>

                <section>
                    <h5>States
                        <button @click="showCreateStateModal = true" class="btn-success btn btn-icon btn-sm">
                            <i class="fa fa-plus"></i></button>
                    </h5>
                    <CDataTable
                        :items="workflow.states"
                        :fields="['label',
                        'code',
                        'is_initial',
                        'actions']"
                        :loading="isLoading"
                        hover
                        :items-per-page="15"
                        column-filter
                        table-filter
                        sorter>
                        <template #actions="{item}">
                            <td>
                                <button @click="deleteState(item)"
                                        class="btn btn-sm btn-icon btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </template>
                        <template #is_initial="{item}">
                            <td>
                                <span class="badge"
                                      :class="{'badge-success':item.is_initial,'badge-warning':!item.is_initial}">
                                    {{ item.is_initial ? 'Initial State' : 'Normal State' }}
                                </span>
                            </td>
                        </template>
                    </CDataTable>
                    <hr>
                </section>

            </CCardBody>
            <CModal title="Create Transition"
                    color="success"
                    size="xl"
                    :show.sync="showCreateTransitionModal">
                <div class="form">
                    <div class="form-group">
                        <label for="transition-label">Transition Label</label>
                        <input type="text" id="transition-label" class="form-control" v-model="transition.label">
                    </div>
                    <div class="form-group">
                        <label for="transition-code">Transition Code</label>
                        <input type="text" id="transition-code" class="form-control" v-model="transition.code">
                    </div>
                    <div class="form-group">
                        <label for="transition-from-state">From State</label>
                        <select type="text" id="transition-from-state" class="form-control"
                                v-model="transition.from_state_id">
                            <option v-for="state in workflow.states"
                                    :key="state.id"
                                    :value="state.id">{{ state.label }}
                                ({{ state.code }})
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transition-to-state">To State</label>
                        <select type="text" id="transition-to-state" class="form-control"
                                v-model="transition.to_state_id">
                            <option v-for="state in workflow.states"
                                    :key="state.id"
                                    :value="state.id">{{ state.label }}
                                ({{ state.code }})
                            </option>
                        </select>
                    </div>
                </div>

                <template #footer>
                    <button @click="showCreateTransitionModal =false"
                            class="btn btn-secondary btn-sm">
                        Close
                    </button>
                    <button @click="createTransition"
                            class="btn btn-success btn-sm">
                        Submit
                    </button>
                </template>

            </CModal>
            <CModal title="Create State"
                    color="success"
                    size="xl"
                    :show.sync="showCreateStateModal">
                <div class="form">
                    <div class="form-group">
                        <label for="state-label">State Label</label>
                        <input type="text" id="state-label" class="form-control" v-model="state.label">
                    </div>
                    <div class="form-group">
                        <label for="state-code">State Code</label>
                        <input type="text" id="state-code" class="form-control" v-model="state.code">
                    </div>
                    <div class="form-group">
                        <label for="state-is_initial">Is Initial State</label>
                        <select id="state-is_initial" class="form-control" v-model="state.is_initial">
                            <option :value="false">No</option>
                            <option :value="true">Yes</option>
                        </select>
                    </div>

                </div>

                <template #footer>
                    <button @click="showCreateStateModal =false"
                            class="btn btn-secondary btn-sm">
                        Close
                    </button>
                    <button @click="createState"
                            class="btn btn-success btn-sm">
                        Submit
                    </button>
                </template>
            </CModal>
        </CCard>
        <CCard v-else>
            <CCardBody>Loading...</CCardBody>
        </CCard>


    </div>
</template>

<script>
import endpoints from "../endpoints"
import WorkflowDiagram from "../components/WorkflowDiagram"
import client from "@/client"

export default {
    name: "ShowIndex",

    data() {
        return {
            isLoading: true,
            workflow: null,
            showCreateTransitionModal: false,
            showCreateStateModal: false,
            transition: {
                label: null,
                code: null,
                from_state_id: null,
                to_state_id: null,
            },
            state: {
                label: null,
                code: null,
                is_initial: false,
            }
        }
    },
    components: {
        WorkflowDiagram
    },
    created() {
        this.fetchWorkflow()
    },
    methods: {
        fetchWorkflow() {
            client.get(endpoints.show(this.$route.params.id))
                .then(({data}) => this.workflow = data)
                .then(() => this.isLoading = false)
                .catch(error => console.log(error))

        },
        createTransition() {
            client.post(endpoints.create_transition(this.$route.params.id), this.transition)
                .then(({data}) => this.workflow.transitions.push(data.transition))
                .then(() => this.showCreateTransitionModal = false)
                .catch(error => console.log(error))
        },
        deleteTransition(transition) {
            if (confirm('are you sure to delete the transition?')) {
                client.delete(endpoints.delete_transition(this.$route.params.id, transition.id))
                    .then(() => this.workflow.transitions = this.workflow.transitions.filter(t => t.id !== transition.id))
                    .catch(error => console.log(error))
            }
        },
        createState() {
            client.post(endpoints.create_state(this.$route.params.id), this.state)
                .then(({data}) => this.workflow.states.push(data.state))
                .then(() => this.showCreateStateModal = false)
                .then(() => this.state = {
                    label: null,
                    code: null,
                    is_initial: false,
                })
                .catch(error => console.log(error))
        },

    }
}
</script>

<style scoped lang="scss">

.ApplicantShow {
    .badge-male {
        background-color: blue;
        color: white
    }

    .badge-female {
        background-color: pink;
        color: white
    }
}

</style>
