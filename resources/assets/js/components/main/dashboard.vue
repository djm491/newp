<template>
    <div id="root">
        <div class="wrapper container">
            <div class="row">
                <div id="recent-sales" class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Servers Info</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content mt-1">
                            <div class="table-responsive" v-if="servers && servers.length">
                                <table id="recent-orders" class="table table-hover table-xl mb-0">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">Server Name</th>
                                        <th class="border-top-0">Online Users</th>
                                        <th class="border-top-0">Open Connections</th>
                                        <th class="border-top-0">Uptime</th>
                                        <th class="border-top-0">RAM</th>
                                        <th class="border-top-0">CPU</th>
                                        <th class="border-top-0">NETWORK</th>
                                        <th class="border-top-0">Live</th>
                                        <th class="border-top-0">Output</th>
                                        <th class="border-top-0">Input</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="server in servers">
                                        <td class="text-truncate">{{server.server_name}}</td>
                                        <td class="text-truncate"></td>
                                        <td class="text-truncate">iPone X</td>
                                        <td class="text-truncate">iPone X</td>
                                        <td>
                                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
                                                     aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
                                                     aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
                                                     aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-truncate">iPone X</td>
                                        <td class="text-truncate">iPone X</td>
                                        <td class="text-truncate">iPone X</td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data () {
            return {
               servers:[]
            }
        },
        created() {
            this.getServers();
        },
        methods: {
            getServers(){
                axios.get('/get-servers', {
                }).then((response) => {
                     const self = this;
                     self.servers = response.data;
                });
            }
        }
    }
</script>
