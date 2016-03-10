<template id="times-template">
    <div class="ui centered grid">
        <div class="eight wide column">
            <div class="inline fields">
                <div class="field">
                    <h4 class="ui header">
                        <i class="wait icon"></i>
                        <div class="content">
                            Start Time
                            <div class="sub header">Time the class begins</div>
                        </div>
                    </h4>
                    <br>
                    <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                        <div class="ui icon input">
                            <input name="start_time[@{{ count }}]" type="text" value="9:30">
                            <i class="wait icon"></i>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <h4 class="ui header">
                        <i class="wait icon"></i>
                        <div class="content">
                            End Time
                            <div class="sub header">Time the class ends</div>
                        </div>
                    </h4>
                    <br>
                    <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                        <div class="ui icon input">
                            <input name="end_time[@{{ count }}]" type="text" value="10:30">
                            <i class="wait icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="eight wide column">
            <div class="inline fields">
                <div class="field">
                    <h4 class="ui header">
                        <i class="calendar icon"></i>
                        <div class="content">
                            Start Date
                            <div class="sub header">Date the class begins</div>
                        </div>
                    </h4>
                    <br>
                    <div class="ui input">
                        <input name="beginning_date[@{{ count }}]" type="text" class="datepicker"/>
                    </div>
                </div>
                <div class="field">
                    <h4 class="ui header">
                        <i class="calendar icon"></i>
                        <div class="content">
                            End Date
                            <div class="sub header">Date the class ends</div>
                        </div>
                    </h4>
                    <br>
                    <div class="ui input">
                        <input name="end_date[@{{ count }}]" type="text" class="datepicker"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="ten wide column">
            <div class="inline fields">
                <div class="field">
                    <h4 class="ui header">
                        <i class="calendar icon"></i>
                        <div class="content">
                            Day
                            <div class="sub header">Day of week for time</div>
                        </div>
                    </h4>
                    <br>
                    <div class="ui circular labels">
                        <a v-on:click="toggleDay" id="sun" class="ui grey circular label day">S</a>
                        <a v-on:click="toggleDay" id="mon" class="ui grey circular label day">M</a>
                        <a v-on:click="toggleDay" id="tue" class="ui grey circular label day">T</a>
                        <a v-on:click="toggleDay" id="wed" class="ui grey circular label day">W</a>
                        <a v-on:click="toggleDay" id="thu" class="ui grey circular label day">T</a>
                        <a v-on:click="toggleDay" id="fri" class="ui grey circular label day">F</a>
                        <a v-on:click="toggleDay" id="sat" class="ui grey circular label day">S</a>
                    </div>
                </div>
                <div class="field">
                    <h4 class="ui header">
                        <i class="repeat icon"></i>
                        <div class="content">
                            Repeats
                            <div class="sub header">How often this time repeats</div>
                        </div>
                    </h4>
                    <br>
                    <div class="ui labels">
                        <input type="hidden" name="repeat[@{{ count }}]" value="w">
                        <a v-on:click="toggleRepeat" id='w' class="ui green label repeat">Weekly</a>
                        <a v-on:click="toggleRepeat" id='b' class="ui grey label repeat">Biweekly</a>
                        <a v-on:click="toggleRepeat" id='m' class="ui grey label repeat">Monthly</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="six wide right floated column">
            <button type="button" class="remove ui labeled icon button">
                <i class="trash icon"></i>
                Remove
            </button>
        </div>
    </div>
</template>
