<template>
	<v-card>
		<v-card-title class="pa-2 primary white--text">
			{{$route.name}}
			<v-spacer></v-spacer>
			<v-btn class="white" @click="addDepartment()"> اضافة قسم</v-btn>
		</v-card-title>
		<v-card-text>
			<v-list subheader>
				<v-subheader>الاقسام</v-subheader>

				<template v-for="(department,index) in departments">

					<v-list-item :key="department.id">
						<v-list-item-avatar color="primary white--text">
							<span class="title">{{index +1 }}</span>
							<!-- <v-img :alt="`${chat.title} avatar`" :src="chat.avatar"></v-img> -->
						</v-list-item-avatar>

						<v-list-item-content>
							<v-list-item-title v-text="department.name"></v-list-item-title>
							<v-list-item-subtitle v-text="department.root"></v-list-item-subtitle>

						</v-list-item-content>

						<v-chip class="mx-2" small label @click.stop="editDepartment(department)">تعديل</v-chip>
						<v-chip color="error" small label @click.stop="deleteDepartment(department.id)">حذف</v-chip>

					</v-list-item>

					<v-divider></v-divider>
				</template>
			</v-list>

		</v-card-text>

		<d-dialog v-model="show_add_item" width="500px" title=" اضافة قسم" @save="saveDepartment">
			<v-text-field outlined dense v-model="department.root" label="الهيئة" :rules="[ v => !!v || 'field is required']" required />
			<v-text-field outlined dense v-model="department.name" label="القسم" :rules="[ v => !!v || 'Name is required']" required />
			<v-text-field outlined type="number" dense v-model="department.order" label="الترتيب" :rules="[ v => !!v || 'Name is required']" required />
			<v-select outlined dense label="الحالة" :items="[{id:'active',name:'نشط'},{id:'in_active',name:'غير نشط'}]" item-text="name" item-value="id" v-model="department.state"></v-select>
			<v-select outlined dense label="اللون" :items="['primary','secondary','success','info','error']" v-model="department.color"></v-select>
		</d-dialog>
	</v-card>
</template>

<script>
	import jsonToFormDataMin from "../../plugins/jsonToFormData.min";
	import { get } from "vuex-pathify";
	export default {
		data() {
			return {
				show_add_item: false,
				department: {
					state: "active",
				},
				search: "",
			};
		},

		created() {
			if (this.departments.length == 0) this.$store.set("departments");
		},

		computed: {
			...get(["departments"]),
		},
		methods: {
			addDepartment() {
				this.department = {
					img: [],
					color: "primary",
				};
				this.show_add_item = true;
			},

			saveDepartment() {
				if (this.department.id) return this.updateDepartment();
				const data = jsonToFormData(this.department);
				this.axios.post("department", data).then((res) => {
					this.$store.set("add", {
						_t: "departments",
						...res.data,
					});
					this.show_add_item = false;
				});
			},

			updateDepartment() {
				this.department._method = "put";
				const data = jsonToFormData(this.department);

				this.axios.post("department/" + this.department.id, data).then((res) => {
					this.$store.set("update", {
						_t: "departments",
						...res.data,
					});

					this.show_add_item = false;
				});
			},

			editDepartment(department) {
				this.department.id = department.id;
				this.department.name = department.name;
				this.department.order = department.order;
				this.department.state = department.state;
				this.department.color = department.color;
				this.department.file_type = department.file_type;
				this.show_add_item = true;
			},

			deleteDepartment(id) {
				if (!confirm("هل انت متاكد من الحذف؟")) return;
				this.axios.delete("department/" + id).then(() => {
					this.$store.set("remove", {
						_t: "departments",
						id: id,
					});
				});
			},
		},
	};
</script>

<style lang="scss" scoped>
	.ph {
		background: #bcc3be;
		padding: 10px;
		border-radius: 30px;
		margin: 10px;
		text-align: center;
	}
</style>
