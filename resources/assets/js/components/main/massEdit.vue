<template>
    
    <article class="module width_full"> 
        <header><h3 class="tabs_involved">Mass Edit Live Streams</h3></header>
        <div class="module_content">
            <fieldset>
                <legend><b>Options</b></legend>
            </fieldset>
            <table id="setting" class="w-100">
                <tbody>
                    <tr>
                        <td>Select Live Streams</td>
                        <td>
                            <div id="streams" class="checklistContainer">
                                <div class="findInList" id="streams_findInListDiv">
                                    <input type="text"
                                           v-model="search" 
                                           placeholder="Type here to search list..." 
                                           id="streams_findInList"
                                           v-on:keyup="filterStreams"
                                           class="form-control">
                                </div>
                                <div id="streams_checklist" class="checklist">
                                    <virtual-list class="checklist" :size="40" :remain="8" wtag="ul">
                                         
                                         <li tabindex="0"
                                             v-for="item of streams"
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
                        </td>    
                    </tr>
                </tbody>    
            </table>
        </div>
    </article>    
    
</template>

<script>
    import virtualList from 'vue-virtual-scroll-list';
    export default {
        components: {
          'virtual-list': virtualList
        },
        data () {
            return {
               search:'', 
               streams:[],
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
                    self.streams = response.data;
                });
            },
            filterStreams(){
                var self=this;   
          }
        }
    }
</script>

<style scoped>
   .card {
      width: 100%;
   }

   li {
     list-style: none;
   } 
   .width_full {
      width: 100%;
      min-width: 100%;
      overflow: auto;
   }
   .module {
    border: 1px solid #9ba0af;
    width: 100%;
    margin-top: 20px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
  }
  .module header {
    height: 34px;
    width: 100%;
    background: #3b3e40;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
  .module_content {
    margin: 10px 20px;
    color: #666;
  }
  fieldset legend {
    background: #dedede;
    color: #000;
    padding: 5px 12px;
    font-size: 15px;
 }
 table#settings td {
    width: 400px;
    padding: 5px;
 }
 div.checklistContainer {
    padding: 4px;
    background: #f7f7f7;
    border: 1px solid #aaa;
    margin-bottom: 10px;
    font-family: Helvetica,arial,verdana,sans-serif;
    font-size: 12px;
    line-height: 1.6em;
    width: 700px;
    float: right;
}
div.findInList {
    margin-bottom: 5px;
}
table#settings input[type=text] {
    width: 99%;
    margin-bottom: 10px;
    background-color: #ccec91;
    border-radius: 4px;
    border: 1px solid #719e37;
    padding: 1px;
}
div.checklist {
    border: 1px solid #aaa;
    color: #555;
    background: #fff;
    overflow-x: hidden;
    overflow-y: auto;
    position: relative;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    margin-left: -38px !important;
}
div.checklist li {
    padding: 3px;
    margin-left: -33px;
}
div.checklist li:nth-child(odd) {
    background-color: #f7f7f7;
}

div.checklist li:nth-child(even) {
    background-color: #fff;
}
div.checklist li input {
    display: block;
    float: left;
    margin-top: 4px;
}
div.checklist label {
    display: block;
    margin: 0;
    padding: 0;
    display: block;
    padding-left: 25px;
}

</style>