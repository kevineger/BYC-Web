<template id="times-template">
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
                <input type="hidden" name="repeat" value="w">
                <a v-on:click="toggleRepeat" id='w' class="ui green label repeat">Weekly</a>
                <a v-on:click="toggleRepeat" id='b' class="ui grey label repeat">Biweekly</a>
                <a v-on:click="toggleRepeat" id='m' class="ui grey label repeat">Monthly</a>
            </div>
        </div>
    </div>
    <div class="inline fields">
        <div class="field">
            <h4 class="ui header">
                <i class="wait icon"></i>
                <div class="content">
                    Start Time
                    <div class="sub header">When the class begins</div>
                </div>
            </h4>
            <br>
            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                <div class="ui icon input">
                    <input type="text" value="9:30">
                    <i class="wait icon"></i>
                </div>
            </div>
        </div>
        <div class="field">
            <h4 class="ui header">
                <i class="wait icon"></i>
                <div class="content">
                    End Time
                    <div class="sub header">When the class ends</div>
                </div>
            </h4>
            <br>
            <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                <div class="ui icon input">
                    <input type="text" value="10:30">
                    <i class="wait icon"></i>
                </div>
            </div>
        </div>
    </div>
</template>
