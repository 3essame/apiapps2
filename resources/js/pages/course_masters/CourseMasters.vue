<template>
	<v-card>
		<v-card-title class="pa-2 primary white--text">
			{{$route.name}}
			<v-spacer></v-spacer>
			<v-btn class="white" @click="addCourseMaster()">اضافة برنامج تدريب</v-btn>
		</v-card-title>

		<v-card-text>
			<v-list subheader>
				<v-subheader>الاقسام</v-subheader>

				<template v-for="(master,index) in course_masters">

					<v-list-item :key="master.id" @click="$router.push('/course_masters/'+ master.id)">
						<v-list-item-avatar color="primary white--text">
							<span class="title">{{index +1 }}</span>
							<!-- <v-img :alt="`${chat.title} avatar`" :src="chat.avatar"></v-img> -->
						</v-list-item-avatar>

						<v-list-item-content>
							<v-list-item-title v-text="master.name"></v-list-item-title>
							<v-list-item-subtitle v-text="master.courses_count + ' دورة ' +  ' | ' +  master.departments_count + ' قسم ' "></v-list-item-subtitle>

						</v-list-item-content>

						<v-chip class="mx-2" small label @click.stop="editCourseMaster(master.id)">تعديل</v-chip>
						<v-chip color="error" small label @click.stop="deleteCourseMaster(master.id)">حذف</v-chip>

					</v-list-item>

					<v-divider></v-divider>
				</template>
			</v-list>
		</v-card-text>

		<d-dialog v-model="show_master_dialog" title="اضافة برنامج تدريب" @save="saveCourseMaster()" width="600px">
			<v-text-field outlined dense label="اسم البرنامج" v-model="master.name" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-textarea label="وصف البرنامج" outlined dense rows="2" v-model="master.description"></v-textarea>
			<v-text-field outlined dense label="المكان" v-model="master.place" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-text-field outlined dense label="النوع" v-model="master.type" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-select label="الاقسام" v-model="master.department_ids" outlined multiple dense :items="departments" item-text="name" item-value="id" append-icon="mdi-refresh" @click:append="$store.set('departments')" :rules="[v=>!!v || 'this field is requird']"></v-select>
			<v-btn small elevation="" color="" @click="addCourse()">اضافة دورة</v-btn>

			<l-table :items="master.courses" :headers="['الاسم|name','البداية|start','النهاية|end','عدد الساعات|duration','خيارات|options']">
				<template #options="{item}">
					<v-icon @click="removeCourse(item)" color="error">mdi-close</v-icon>
				</template>
			</l-table>

		</d-dialog>

		<d-dialog v-model="show_course_dialog" title="اضافة  دورة" @save="saveCourse()" width="600px">
			<v-text-field outlined dense label="اسم الدورة" v-model="course.name" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-textarea label="وصف الدورة" outlined dense rows="2" v-model="course.description"></v-textarea>
			<v-text-field outlined dense label="تاريخ البداية" type="date" v-model="course.start" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-text-field outlined dense label="تاريخ النهاية" type="date" v-model="course.end" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-text-field outlined dense label="عدد الساعات" type="number" v-model="course.duration" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<template #tools>
				<v-btn @click="saveCourse()">حفظ</v-btn>
				<v-btn @click="saveCourse('save_and_new')">حفظ وجديد</v-btn>
				<v-btn @click="show_course_dialog=false">الغاء</v-btn>
			</template>
		</d-dialog>
	</v-card>
</template>

<script>
	import { get } from 'vuex-pathify'
	import lTable from '../../components/LTable'
	export default {
		data() {
			return {
				show_master_dialog: false,
				show_course_dialog: false,
				master: {},
				course: {}
			}
		},
		components: {
			lTable
		},
		created() {
			if (this.course_masters.length == 0) this.fechCourseMasters()

		},
		computed: {
			...get(['departments', 'course_masters']),
		},

		methods: {
			fechCourseMasters() {
				this.$store.set('courseMasters')
			},
			addCourseMaster() {
				this.master = { courses: [] }
				this.show_master_dialog = true
			},

			saveCourseMaster() {
				if (this.master.id) return this.updateCourseMaster()
				axios.post('course-master', this.master).then(res => {
					this.$store.set('add', { _t: 'course_masters', ...res.data })
					this.show_master_dialog = false
				})
			},
			updateCourseMaster() {
				axios.put('course-master/' + this.master.id, this.master).then(res => {
					this.$store.set('update', { _t: 'course_masters', ...res.data })
					this.show_master_dialog = false
				})
			},

			editCourseMaster(id) {
				axios.get('course-master/' + id).then(res => {
					this.master = res.data
					this.master.department_ids = this.master.departments.map(d => d.id)
					this.show_master_dialog = true
				})
			},

			deleteCourseMaster(id) {
				if (!confirm('هل انت متاكد من الحذف')) return
				axios.delete('course-master/' + id).then(res => {
					this.$store.set('remove', { _t: 'course_masters', id: id })
				})

			},

			addCourse() {
				this.courese = {}
				this.show_course_dialog = true
			},

			saveCourse(mode) {
				this.master.courses.push({ ...this.course })
				this.course.name = ''
				if (mode != 'save_and_new') this.show_course_dialog = false
			},

			removeCourse(course) {
				this.master.courses = this.master.courses.filter(c => c != course)
			}
		}
	}
</script>

<style lang="scss" scoped>
</style>