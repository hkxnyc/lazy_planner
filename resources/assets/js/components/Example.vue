<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component {{textInput.data}}</div>
                    <div class="panel-body">
                        <input type="text" v-model="textInput.data">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        ready() {
            console.log('Component ready.')
        },
        props : {
            textInput : {

            }
        }
    }
</script>
