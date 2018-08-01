<template>

    <div id ="root">
        <div class="card w-100">
            <div class="card-header">
                <h4 class="card-title">Mass Edit Live Streams(Options)</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <!-- All Streams -->
                    <div class="mass_edit_section">
                        <label>Select Live Streams</label>
                        <div id="streams" class="checklistContainer">
                            <div class="findInList" id="streams_findInListDiv">
                                <input type="text"
                                       v-model="search"
                                       placeholder="Type here to search list..."
                                       id="streams_findInList"
                                       class="form-control search-input">
                            </div>
                            <div id="streams_checklist" class="checklist">
                                <virtual-list class="checklist" :size="40" :remain="8" wtag="ul">

                                    <li tabindex="0"
                                        v-for="item in filterstreams"
                                        class="even"
                                        :key="item.id"
                                    >
                                        <input type="checkbox"
                                               :value="item.id"
                                               name="streams[]"
                                               :id="item.id">
                                        <label class="leaveRoomForCheckbox">
                                            {{item.name}}
                                        </label>
                                    </li>
                                </virtual-list>
                            </div>
                        </div>
                    </div>
                    <div class="mass_edit_section">
                        <label>Category Name</label>
                        <select class="form-control">
                            <option value="">Do not Change</option>
                            <option value="">Don't Use Category</option>
                            <option v-for="c in categories" :id="c.id">{{c.category_name}}</option>
                        </select>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>
                            <img v-b-tooltip.hover title="Choose YES, if you want the stream to have an RTMP Output along with the MPEGTS/HLS."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            RTMP Output
                        </label>
                        <div class="radio-group">
                            <b-form-radio-group  v-model="rtmp_output_selected" :options="rtmp_output_options"></b-form-radio-group>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>
                            <img v-b-tooltip.hover title="Generate New Timestamps"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Generate New Timestamps
                        </label>
                        <div class="radio-group">
                            <b-form-radio-group v-model="new_timestamp_selected" :options="new_timestamp_options"></b-form-radio-group>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>
                            <img v-b-tooltip.hover title="This option will stream all codecs from your stream. Some streams have more than one audio/video/subtitles channels. If you want to stream them all as one, then you need to enable this option."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Read Input Source in Native Frames
                        </label>
                        <div class="radio-group">
                            <b-form-radio-group v-model="read_native_selected" :options="read_native_options"></b-form-radio-group>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>
                            <img v-b-tooltip.hover title="This option will stream all codecs from your stream. Some streams have more than one audio/video/subtitles channels. If you want to stream them all as one, then you need to enable this option."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Stream all the codecs found on the video
                        </label>
                        <div class="radio-group">
                            <b-form-radio-group v-model="stream_all_selected" :options="stream_all_options"></b-form-radio-group>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label></label>
                        <div class="radio-group">
                            <b-form-checkbox-group stacked name="flavour2" :options="days_options"></b-form-checkbox-group>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label></label>
                        <input type="text" class="form-control w-500" name="restart_in" placeholder="Example: 16:00">
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>Restart Streams After Editing</label>
                        <div class="radio-group">
                            <b-form-radio-group v-model="restart_streams_selected" :options="restart_streams_options"></b-form-radio-group>
                        </div>    
                    </div>    

                </div>
            </div>
        </div>
        <div class="card w-100">
            <div class="card-header">
                <h4 class="card-title">Mass Edit Live Streams(Fetching Options)</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="mass_edit_section">
                        <label>
                          <img v-b-tooltip.hover title="Choose YES, if you want the stream to have an RTMP Output along with the MPEGTS/HLS."
                               src="/app-assets/images/massEditStreams/question.png"/>
                          User Agent
                       </label>
                        <div class="radio-group">
                            <input class="form-control w-75 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-5"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                     </div>
                    <div class="mass_edit_section mt-1">
                        <label>
                            <img v-b-tooltip.hover title="Set an HTTP Proxy in this format: ip:port"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            HTTP Proxy
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-75 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-5"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>
                            <img v-b-tooltip.hover title="Set an HTTP Cookie that might be useful to fetch your INPUT Source."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Cookie
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-75 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-5"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card w-100">
            <div class="card-header">
                <h4 class="card-title">OnDemand Servers</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="mass_edit_section">
                        <label>
                            Action On-Demand
                        </label>
                        <div class="radio-group">
                            <b-form-radio-group v-model="on_demand_selected"
                            :options="on_demand_options"
                            stacked
                            name="radiosStacked">
                            </b-form-radio-group>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>
                            <img v-b-tooltip.hover title="Set an HTTP Proxy in this format: ip:port"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            HTTP Proxy
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-75 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-5"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>
                            <img v-b-tooltip.hover title="Set an HTTP Cookie that might be useful to fetch your INPUT Source."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Cookie
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-75 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-5"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label v-b-tooltip.hover title="The less, the faster will open the stream. However if you put a very low number here, the stream might not start. The number is in bytes. A good value for Xtream Codes Sources is 128000 . For other solution it might need a higher number">Probesize On-Demand</label>
                        <div class="radio-group">
                            <input type="text" class="form-control" name="probesize_ondemand" v-model="probeSize"/>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1">
                        <label>Select Servers</label>
                        <div class="radio-group">
                            <model-select :options="servers"
                                          placeholder="select Server">
                            </model-select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card w-100">
            <div class="card-header">
                <h4 class="card-title">STB Devices (Stalker Portal)</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="mass_edit_section">
                        <label>
                            <img v-b-tooltip.hover title="If you want to allow your Clients to be able to Record this Channel into a USB Device from stalker portal you can enable this setting."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Allow Recording of The Stream
                        </label>
                        <div class="radio-group">
                            <b-form-radio-group v-model="allow_record_selected"
                                                :options="allow_record_options"
                                                stacked
                                                name="radiosStacked">
                            </b-form-radio-group>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card w-100">
            <div class="card-header">
                <h4 class="card-title">STB Devices (Stalker Portal)</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="mass_edit_section">
                        <label>
                            <img v-b-tooltip.hover title="If you want to allow your Clients to be able to Record this Channel into a USB Device from stalker portal you can enable this setting."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Allow Recording of The Stream
                        </label>
                        <div class="radio-group">
                            <b-form-radio-group v-model="allow_record_selected"
                                                :options="allow_record_options"
                                                stacked
                                                name="radiosStacked">
                            </b-form-radio-group>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</template>

<script>
    import virtualList from 'vue-virtual-scroll-list';
    import { ModelSelect } from 'vue-search-select';
    export default {
        components: {
          'virtual-list': virtualList,
            ModelSelect
        },
        data () {
            return {
                probeSize : 0,
                rtmp_output_selected: 'first',
                rtmp_output_options: [
                    { text: 'Do not Change', value: 'first' },
                    { text: 'Yes', value: 'second' },
                    { text: 'No', value: 'No' }
                ],
                new_timestamp_selected: 'first',
                new_timestamp_options: [
                    { text: 'Do not Change', value: 'first' },
                    { text: 'Yes', value: 'second' },
                    { text: 'No', value: 'No' }
                ],
                read_native_selected: 'first',
                read_native_options: [
                    { text: 'Do not Change', value: 'first' },
                    { text: 'Yes', value: 'second' },
                    { text: 'No', value: 'No' }
                ],
                stream_all_selected: 'first',
                stream_all_options: [
                    { text: 'Do not Change', value: 'first' },
                    { text: 'Yes', value: 'second' },
                    { text: 'No', value: 'No' }
                ],
                days_options :[
                    {text:'Sunday',value:'Sunday'},
                    {text:'Munday',value:'Munday'},
                    {text:'Tuesday',value:'Tuesday'},
                    {text:'Wednesday',value:'Wednesday'},
                    {text:'Thursday',value:'Thursday'},
                    {text:'Friday',value:'Friday'},
                    {text:'Saturday',value:'Saturday'},
                ],
                restart_streams_selected: 1,
                restart_streams_options :[
                    {text:'Yes', value:1},
                    {text:'No', value:0}
                ],
                on_demand_selected: -1 ,
                on_demand_options: [
                    {text:'Do not Change', value: -1},
                    {text:'Change ProbeSize Only', value:3},
                    {text:'Remove On-Demand from selected streams' , value:0},
                    {text:'Enable On-Demand for All Servers in Selected Streams',value: 2},
                    {text:'Enable On-Demand to servers below', value:1}
                ],
                allow_record_selected: -1,
                allow_record_options: [
                    {text:'Do not Change', value: -1},
                    {text:'Yes', value:1},
                    {text:'No' , value:0},
                ],
                servers: [{}],
                search:undefined,
                streams:[],
                categories: [],
            }
        },
        created() {
            this.getStreams();
        },
        methods: {
            getStreams () {
                axios.get('/get-streams', {

                }).then((response) => {
                    let self = this;
                    self.streams = response.data.streams;
                    self.categories = response.data.stream_categories;
                    self.probeSize = response.data.probeSize.probeSize;
                    self.servers = response.data.servers;
                });
            },
        },
        computed: {
            filterstreams() {
                var self = this;
                let streams = self.streams;
                if (self.search) {
                    streams = streams.filter((p) => {
                        return p.name.indexOf(self.search) !== -1
                    })
                }
                return streams;
            }
        }
    }
</script>

<style scoped>


</style>