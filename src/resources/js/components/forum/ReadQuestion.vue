<template>
    <div>
        <v-card-text>
        <v-layout align-center>
            <v-flex xs7>
            <div>
                <h2>{{question_data.title}}</h2>
            </div>
            </v-flex>
        </v-layout>
        </v-card-text>
        <v-card-text>
        <v-layout align-center>
            <v-flex mx-3>
            <!-- Defining as a computed property "question_body" parse the question data as html (since we're using a WYSIWYG editor to create questions )-->
            <p class="text-xs-left" v-html="question_body"></p>
            </v-flex>
        </v-layout>
        </v-card-text>
        <v-card-text>
        <h6>Created by: {{ question_data.user }} : [{{question_data.date_readable}}]</h6>
        </v-card-text>
        <v-card-text v-if="is_owner">
        <v-row>
            <v-col cols="12" sm="1">
            <v-btn class="mx-2" fab dark large color="cyan" @click="enableEdit">
                <v-icon dark>mdi-pencil</v-icon>
            </v-btn>
            </v-col>
            <v-col cols="12" sm="1">
            <v-btn class="mx-2" fab dark large color="orange" @click="deleteQuestion">
                <v-icon dark>mdi-delete</v-icon>
            </v-btn>
            </v-col>
        </v-row>
        </v-card-text>
    </div>
</template>

<script>
export default {
    props: ['question_data', 'is_owner'],

    computed: {
        //render question body data in HTML format
        question_body() {
        return md.parse(this.question_data.body);
        }
    },

    methods: {
        enableEdit() {
            EventBus.$emit('enableEdit')
        },

        deleteQuestion() {
            axios.delete(`/api/questions/${this.$route.params.slug}`).then(res => {
                this.$router.push({ name: "forum" });
            });
        }
    }
};
</script>
