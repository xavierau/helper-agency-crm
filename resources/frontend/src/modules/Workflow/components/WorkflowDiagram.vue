<template>
    <div ref="cy"></div>
</template>

<script>
import cytoscape from 'cytoscape'
import klay from 'cytoscape-klay';
import dagre from 'cytoscape-dagre';

cytoscape.use(klay)
cytoscape.use(dagre)

export default {
    name: "WorkflowDiagram",
    props: {
        workflow: {
            type: Object,
            required: true
        }
    },
    watch: {
        workflow() {
            this.draw()
        }
    },
    mounted() {
        this.draw()
    },
    methods: {
        draw() {
            let states = this.workflow.states.map(s => {
                return {
                    data: {
                        id: `s_${s.id}`,
                        label: s.label
                    }
                }
            })

            let transitions = this.workflow.transitions.map(t => {
                return {
                    data: {
                        id: `t_${t.id}`,
                        label: t.label,
                        source: `s_${t.from_state.id}`,
                        target: `s_${t.to_state.id}`,
                    }
                }
            })

            let elements = states.concat(transitions)
            let layout = window.innerHeight > window.innerWidth ? 'dagre' : 'klay'


            cytoscape({

                container: this.$refs.cy,

                elements: elements,

                style: [ // the stylesheet for the graph
                    {
                        selector: 'node',
                        style: {
                            'height': 10,
                            'width': 10,
                            'font-size': '6px',
                            'background-color': '#1e4df3',
                            'label': 'data(label)'
                        }
                    },
                    {
                        selector: 'edge',
                        style: {
                            'label': 'data(label)',
                            'font-size': '5px',
                            'width': 2,
                            'line-color': '#ccc',
                            'target-arrow-color': '#ccc',
                            'target-arrow-shape': 'triangle',
                            'curve-style': 'bezier'
                        }
                    }
                ],

                layout: {
                    name: layout,

                    // some more options here...
                },

            })
        }
    }
}
</script>

<style scoped>

</style>
