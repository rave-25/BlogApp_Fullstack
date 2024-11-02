<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div
                    class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
                >
                    <p class="_title0">
                        Tags
                        <Button @click="addModal = true">
                            <Icon type="md-add" /> Add tag
                        </Button>
                    </p>

                    <div class="_overflow _table_div">
                        <table class="_table">
                            <!-- TABLE TITLE -->
                            <tr>
                                <th>ID</th>
                                <th>Tag name</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            <!-- TABLE TITLE -->

                            <!-- ITEMS -->
                            <tr v-for="(tag, i) in tags" :key="i">
                                <td>{{ tag.id }}</td>
                                <td class="_table_name">{{ tag.tagName }}</td>
                                <td>{{ tag.created_at }}</td>
                                <td>
                                    <Button
                                        type="info"
                                        size="small"
                                        @click="showEditModal(tag, i)"
                                        >Edit</Button
                                    >
                                    <Button type="error" size="small"
                                        >Delete</Button
                                    >
                                </td>
                            </tr>

                            <!-- ITEMS -->
                        </table>
                    </div>
                </div>
                <!-- tag adding modal -->
                <Modal
                    v-model="addModal"
                    title="Add tag"
                    :mask-closable="false"
                    :closable="false"
                >
                    <Input v-model="data.tagName" placeholder="Add tag name" />

                    <template #footer>
                        <Button type="default" @click="addModal = false"
                            >Close</Button
                        >
                        <Button
                            type="primary"
                            @click="addTag"
                            :disabled="isAdding"
                            :loading="isAdding"
                        >
                            {{ isAdding ? "Adding.." : "Add tag" }}
                        </Button>
                    </template>
                </Modal>
                <!-- Edit Modal -->

                <!-- Edit Modal -->
                <Modal
                    v-model="editModal"
                    title="Edit tag"
                    :mask-closable="false"
                    :closable="false"
                >
                    <Input
                        v-model="editData.tagName"
                        placeholder="Edit tag name"
                    />

                    <template #footer>
                        <Button type="default" @click="editModal = false"
                            >Close</Button
                        >
                        <Button
                            type="primary"
                            @click="editTag"
                            :disabled="isAdding"
                            :loading="isAdding"
                        >
                            {{ isAdding ? "Editing.." : "Edit tag" }}
                        </Button>
                    </template>
                </Modal>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            data: {
                tagName: "",
            },
            addModal: false,
            editModal: false,
            isAdding: false,
            tags: [],
            editData: {
                tagName: "",
            },
            index: -1,
            websiteSettings: [],
        };
    },
    created() {
        this.fetchTags();
    },

    methods: {
        async addTag() {
            if (this.data.tagName.trim() === "") {
                return this.e("Tag name is required"); // Ensure e method is defined or imported
            }

            this.isAdding = true;
            try {
                const res = await this.callApi("post", "app/create_tag", this.data);
                if (res.status === 201) {
                    this.tags.unshift(res.data);
                    this.s("Tag has been added successfully!");
                    this.addModal = false;
                    this.data.tagName = "";
                } else if (res.status === 422 && res.data.errors.tagName) {
                    this.e(res.data.errors.tagName[0]); // Display validation error
                } else {
                    this.swr();
                }
            } catch (error) {
                console.error("API call error:", error);
                this.swr();
            } finally {
                this.isAdding = false;
            }
        },

        async fetchTags() {
            const res = await this.callApi("get", "app/get_tags");
            if (res.status === 200) {
                this.tags = res.data;
            } else {
                this.swr();
            }
        },

        async editTag() {
            if (this.editData.tagName.trim() === "") {
                return this.e("Tag name is required");
            }

            this.isAdding = true;
            try {
                const res = await this.callApi("post", "app/edit_tag", this.editData);
                if (res.status === 200) {
                    this.tags[this.index].tagName = this.editData.tagName;
                    this.s("Tag has been edited successfully!"); // Ensure s is defined for success handling
                    this.editModal = false;
                } else if (res.status === 422 && res.data.errors.tagName) {
                    this.e(res.data.errors.tagName[0]);
                } else {
                    this.swr(); // Handle unexpected response (ensure swr is defined)
                }
            } catch (error) {
                console.error("API call error:", error);
                this.swr(); // Error handling function
            } finally {
                this.isAdding = false;
            }
        },

        showEditModal(tag, index) {
            this.editData = { id: tag.id, tagName: tag.tagName };
            this.editModal = true;
            this.index = index;
        },
    }, // Add semicolon here
};
</script>

