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
                            <input class="form-control w-85 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
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
                            <input class="form-control w-85 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
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
                            <input class="form-control w-85 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
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
                            <b-form-radio-group
                                    v-model="on_demand_selected"
                                    :options="on_demand_options"
                                    stacked
                            >
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
                            <input class="form-control w-85 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
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
                            <input class="form-control w-85 inline" name="arguments[1]" >
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
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
                            <select class="block servers_block" multiple="multiple" v-if="servers && servers.length">
                                <option v-for="s in servers" :value="s.id">{{s.name}}</option>
                            </select>
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
                <h4 class="card-title">Transcode Stream</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="mass_edit_section">
                        <label>
                            <img v-b-tooltip.hover title="Sometimes, in order to make a stream compatible with most devices, it must be transcoded. Please note that the transcode will only be applied to the server(s) that take the stream directly from the source, all other servers attached to the transcoding server will not transcode the stream."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Allow Recording of The Stream
                        </label>
                        <div class="radio-group">
                            <select class="form-control" v-model="transcodeSelected">
                                <option value="-2">Do not Change</option>
                                <option value="0">No Transcode</option>
                                <option v-for="t in transcoding_profiles" :value="t.profile_id">{{t.profile_name}}</option>
                                <option value="-1">Custom Transcoding Options</option>
                            </select>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                            <label>
                                Video Codec
                            </label>
                            <div class="radio-group">
                                <select class="form-control w-85 inline" name="transcode_attributes[-vcodec]">
                                    <option value="0">Copy Codec [ Associated Transcoding Options Will not work ]</option>
                                    <option value="apng">APNG (Animated Portable Network Graphics) image</option>
                                    <option value="cavs">Chinese AVS (Audio Video Standard) (AVS1-P2, JiZhun profile) (encoders: libxavs )</option>
                                    <option value="cinepak">Cinepak</option>
                                    <option value="ffv1">FFmpeg video codec #1</option>
                                    <option value="flashsv">Flash Screen Video v1</option>
                                    <option value="flashsv2">Flash Screen Video v2</option>
                                    <option value="flv1">FLV / Sorenson Spark / Sorenson H.263 (Flash Video) (decoders: flv ) (encoders: flv )</option>
                                    <option value="gif">GIF (Graphics Interchange Format)</option>
                                    <option value="h261">H.261</option>
                                    <option value="h263">H.263 / H.263-1996, H.263+ / H.263-1998 / H.263 version 2</option>
                                    <option value="h263p">H.263+ / H.263-1998 / H.263 version 2</option>
                                    <option value="h264">H.264 / AVC / MPEG-4 AVC / MPEG-4 part 10 (encoders: libx264 libx264rgb )</option>
                                    <option value="hevc">H.265 / HEVC (High Efficiency Video Coding) (encoders: libx265 )</option>
                                    <option value="mpeg1video">MPEG-1 video</option>
                                    <option value="mpeg2video">MPEG-2 video (decoders: mpeg2video mpegvideo )</option>
                                    <option value="mpeg4">MPEG-4 part 2 (encoders: mpeg4 libxvid )</option>
                                    <option value="msmpeg4v2">MPEG-4 part 2 Microsoft variant version 2</option>
                                    <option value="msmpeg4v3">MPEG-4 part 2 Microsoft variant version 3 (decoders: msmpeg4 ) (encoders: msmpeg4 )</option>
                                    <option value="msvideo1">Microsoft Video 1</option>
                                    <option value="png">PNG (Portable Network Graphics) image</option>
                                    <option value="qtrle">QuickTime Animation (RLE) video</option>
                                    <option value="roq">id RoQ video (decoders: roqvideo ) (encoders: roqvideo )</option>
                                    <option value="rv10">RealVideo 1.0</option>
                                    <option value="rv20">RealVideo 2.0</option>
                                    <option value="snow">Snow</option>
                                    <option value="svq1">Sorenson Vector Quantizer 1 / Sorenson Video 1 / SVQ1</option>
                                    <option value="theora">Theora (encoders: libtheora )</option>
                                    <option value="vp8">On2 VP8 (decoders: vp8 libvpx ) (encoders: libvpx )</option>
                                    <option value="vp9">Google VP9 (decoders: vp9 libvpx-vp9 ) (encoders: libvpx-vp9 )</option>
                                    <option value="wmv1">Windows Media Video 7</option>
                                    <option value="wmv2">Windows Media Video 8</option>
                                    <option value="zmbv">Zip Motion Blocks Video</option>
                                </select>
                                <b-form-checkbox id="checkbox1"
                                                 value="1"
                                                 class="ml-2"
                                                 unchecked-value="0">
                                </b-form-checkbox>
                            </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            Audio Codec
                        </label>
                        <div class="radio-group">
                            <select class="form-control w-85 inline" name="transcode_attributes[-acodec]">
                                <option value="0">Copy Codec [ Associated Transcoding Options Will not work ]</option>
                                <option value="aac">AAC (Advanced Audio Coding) (decoders: aac aac_fixed )</option>
                                <option value="ac3">ATSC A/52A (AC-3) (decoders: ac3 ac3_fixed ) (encoders: ac3 ac3_fixed )</option>
                                <option value="adpcm_adx">SEGA CRI ADX ADPCM</option>
                                <option value="adpcm_g722">G.722 ADPCM (decoders: g722 ) (encoders: g722 )</option>
                                <option value="adpcm_g726">G.726 ADPCM (decoders: g726 ) (encoders: g726 )</option>
                                <option value="adpcm_ima_qt">ADPCM IMA QuickTime</option>
                                <option value="adpcm_ima_wav">ADPCM IMA WAV</option>
                                <option value="adpcm_ms">ADPCM Microsoft</option>
                                <option value="adpcm_swf">ADPCM Shockwave Flash</option>
                                <option value="adpcm_yamaha">ADPCM Yamaha</option>
                                <option value="comfortnoise">RFC 3389 Comfort Noise</option>
                                <option value="dts">DCA (DTS Coherent Acoustics) (decoders: dca ) (encoders: dca )</option>
                                <option value="eac3">ATSC A/52B (AC-3, E-AC-3)</option>
                                <option value="g723_1">G.723.1</option>
                                <option value="mp2">MP2 (MPEG audio layer 2) (decoders: mp2 mp2float ) (encoders: mp2 mp2fixed )</option>
                                <option value="mp3">MP3 (MPEG audio layer 3) (decoders: mp3 mp3float ) (encoders: libmp3lame )</option>
                                <option value="nellymoser">Nellymoser Asao</option>
                                <option value="opus">Opus (Opus Interactive Audio Codec) (decoders: opus libopus ) (encoders: libopus )</option>
                                <option value="pcm_alaw">PCM A-law / G.711 A-law</option>
                                <option value="pcm_mulaw">PCM mu-law / G.711 mu-law</option>
                                <option value="ra_144">RealAudio 1.0 (14.4K) (decoders: real_144 ) (encoders: real_144 )</option>
                                <option value="roq_dpcm">DPCM id RoQ</option>
                                <option value="vorbis">Vorbis (decoders: vorbis libvorbis ) (encoders: vorbis libvorbis )</option>
                                <option value="wavpack">WavPack</option>
                                <option value="wmav1">Windows Media Audio 1</option>
                                <option value="wmav2">Windows Media Audio 2</option>
                            </select>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="A preset is a collection of options that will provide a certain encoding speed to compression ratio. A slower preset will provide better compression (compression is quality per filesize). This means that, for example, if you target a certain file size or constant bit rate, you will achieve better quality with a slower preset. Similarly, for constant quality encoding, you will simply save bitrate by choosing a slower preset."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Preset
                        </label>
                        <div class="radio-group">
                            <select name="transcode_attributes[-preset]" class="form-control inline w-85">
                                <option value="">Use Default Medium</option>
                                <option value="ultrafast">Ultra Fast</option>
                                <option value="superfast">Super Fast</option>
                                <option value="veryfast">Very Fast</option>
                                <option value="faster">Faster</option>
                                <option value="fast">Fast</option>
                                <option value="slow">Slow</option>
                                <option value="slower">Slower</option>
                                <option value="veryslow">Very Slow</option>
                                <option value="placebo">Placebo</option>
                            </select>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="If you want your videos to have highest compatibility with target devices (older iOS versions or all Android devices)"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Video Profile
                        </label>
                        <div class="radio-group">
                            <select name="transcode_attributes[-profile:v]" class="form-control w-85 inline">
                                <option value="">Don't Use Profile</option>
                                <option value="baseline -level 3.0">All devices</option>
                                <option value="baseline -level 3.1">iPhone 3G and later, iPod touch 2nd generation and later</option>
                                <option value="main -level 3.1">iPad (all versions), Apple TV 2 and later, iPhone 4 and late</option>
                                <option value="main -level 4.0">Apple TV 3 and later, iPad 2 and later, iPhone 4s and later</option>
                                <option value="high -level 4.0">Apple TV 3 and later, iPad 2 and later, iPhone 4s and later</option>
                                <option value="high -level 4.1">iPad 2 and later, iPhone 4s and later, iPhone 5c and later</option>
                                <option value="high -level 4.2">iPad Air and later, iPhone 5s and later</option>
                            </select>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="A preset is a collection of options that will provide a certain encoding speed to compression ratio. A slower preset will provide better compression (compression is quality per filesize). This means that, for example, if you target a certain file size or constant bit rate, you will achieve better quality with a slower preset. Similarly, for constant quality encoding, you will simply save bitrate by choosing a slower preset."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Video Profile
                        </label>
                        <div class="radio-group">
                            <select name="transcode_attributes[-profile:v]" class="form-control w-85 inline">
                                <option value="">Don't Use Profile</option>
                                <option value="baseline -level 3.0">All devices</option>
                                <option value="baseline -level 3.1">iPhone 3G and later, iPod touch 2nd generation and later</option>
                                <option value="main -level 3.1">iPad (all versions), Apple TV 2 and later, iPhone 4 and late</option>
                                <option value="main -level 4.0">Apple TV 3 and later, iPad 2 and later, iPhone 4s and later</option>
                                <option value="high -level 4.0">Apple TV 3 and later, iPad 2 and later, iPhone 4s and later</option>
                                <option value="high -level 4.1">iPad 2 and later, iPhone 4s and later, iPhone 5c and later</option>
                                <option value="high -level 4.2">iPad Air and later, iPhone 5s and later</option>
                            </select>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="With this you can change the bitrate of the target video. It is very useful in case you want your video to be playable on slow internet connections"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Average Video Bit Rate
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="Change Audio Bitrate"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Average Audio Bitrate
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="-minrate FFmpeg argument. Specify the minimum bitrate tolerance here. Specify in kbps. Enter INT number."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Minimum Bitrate Tolerance
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="-maxrate FFmpeg argument. Specify the maximum bitrate tolerance here.Specify in kbps. Enter INT number."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Maximum Bitrate Tolerance
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="-bufsize is the rate control buffer. Basically it is assumed that the receiver/end player will buffer that much data so its ok to fluctuate within that much. Specify in kbps. Enter INT number."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Buffer Size
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="The range of the quantizer scale is 0-51: where 0 is lossless, 23 is default, and 51 is worst possible. A lower value is a higher quality and a subjectively sane range is 18-28. Consider 18 to be visually lossless or nearly so: it should look the same or "
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            CRF Value
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="Change the Width & Height of the target Video. (Eg. 320:240 ) .  If we'd like to keep the aspect ratio, we need to specify only one component, either width or height, and set the other component to -1. (eg 320:-1)"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Scaling
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="Change the target Video Aspect. (eg 16:9)"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Aspect
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="Set the frame rate"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Target Video FrameRate
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="Set the Audio Sample rate in Hz"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Audio Sample Rate
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="Specify Audio Channels"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Audio Channels
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="With this filter you can remove sensitive parts in your video. You will just specifiy the x & y pixels where there is a sensitive area and the width and height that will be removed. Example Use: x=0:y=0:w=100:h=77:band=10 "
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Remove Sensitive Parts (delogo filter)
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="Specify the number of threads you want to use for the transcoding process. Entering 0 as value will make FFmpeg to choose the most optimal settings"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Threads
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="Add your Own Logo to the stream. The logo will be placed in the upper left. Please be sure that you have selected H.264 as codec otherwise this option won't work. Note that adding your own logo will consume A LOT of cpu power"
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            Logo Path
                        </label>
                        <div class="radio-group">
                            <input class="form-control w-85 inline"/>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="mass_edit_section mt-1" v-if="transcodeSelected == '-1'">
                        <label>
                            <img v-b-tooltip.hover title="It check pixels of previous, current and next frames to re-create the missed field by some local adaptive method (edge-directed interpolation) and uses spatial check to prevent most artifacts."
                                 src="/app-assets/images/massEditStreams/question.png"/>
                            DeInterlacing Filter
                        </label>
                        <div class="radio-group">
                            <b-form-radio-group v-model="arguments_selected"
                                                :options="arguments_options"
                                                class="w-85 inline"
                            >
                            </b-form-radio-group>
                            <b-form-checkbox id="checkbox1"
                                             value="1"
                                             class="ml-2"
                                             unchecked-value="0">
                            </b-form-checkbox>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions">
            <button class="btn btn-success">Mass Edit Streams</button>
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
                transcodeSelected: '-2',
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
                on_demand_selected: -1,
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
                arguments_selected: 0,
                arguments_options: [
                    {text:'Yes', value:1},
                    {text:'No' , value:0},
                ],
                servers: [{}],
                search:undefined,
                streams:[],
                categories: [],
                transcoding_profiles : [],
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
                    self.transcoding_profiles = response.data.transcoding_profiles;
                });
            },
        },
        computed: {
            filterstreams() {
                var self = this;
                let streams = self.streams;
                if (self.search) {
                    streams = streams.filter((p) => {
                        return p.name.toLowerCase().indexOf(self.search.toLowerCase()) !== -1;
                    });
                }
                return streams;
            }
        }
    }
</script>

<style scoped>


</style>