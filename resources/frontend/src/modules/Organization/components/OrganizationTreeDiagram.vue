<template>
    <div ref="cy"></div>
</template>

<script>
import cytoscape from 'cytoscape'
import dagre from 'cytoscape-dagre';

cytoscape.use(dagre)

export default {
    name: "OrganizationTreeDiagram",
    props: {
        organizations: {
            type: Array,
            required: true
        }
    },
    watch: {
        organizations() {
            this.draw()
        }
    },
    mounted() {
        this.draw()
    },
    methods: {
        draw() {
            let orgs = this.organizations.map(o => {
                return {
                    data: {
                        id: `o_${o.id}`,
                        label: o.label
                    }
                }
            })

            let links = this.organizations
                .filter(o => o.parent !== null)
                .map(o => {
                    return {
                        data: {
                            id: `l_${o.id}`,
                            label: o.label,
                            source: o.parent ? `o_${o.parent.id}` : null,
                            target: `o_${o.id}`,
                        }
                    }
                })

            let elements = orgs.concat(links)


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
                    name: 'dagre',

                    // some more options here...
                },

            })
        }
    }
}
</script>

<style scoped>

</style>
