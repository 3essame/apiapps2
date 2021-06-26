<template>
	<div>
		<v-row>
			<v-col cols="12">

				<div class="justify-center d-flex align-center flex-column">
					<v-card class="center justify-center" lef="50%" right="50%" width="400px" outlined>
						<v-card-title class="justify-center flex-column white--text" style="font-size: 1.5rem">
							<img width="100%" :src="'/storage/'+ general_settings.main_logo">
						</v-card-title>
						<v-card-text v-if="$auth.check() == false">
							<div class="alert alert-danger" v-if="has_error">
								البيانات غير صحيحة
							</div>

							<v-form lazy-validation @keyup.native.enter="login" ref="form">
								<v-text-field prepend-inner-icon="mdi-account" outlined dense v-model="email" focusable label="البريد الإلكتروني" :rules="[
                                v => !!v || 'البريد الإلكتروني مطلوب',
                                v => /.+@.+/.test(v) || 'E-mail must be valid'
                            ]" required />
								<v-text-field prepend-inner-icon="mdi-lock" outlined dense v-model="password" type="password" label="كلمة المرور" :rules="[
                                v => !!v || 'كلمة المرور مطلوبة',
                                v => (v && v.length >= 6) || 'يرجي إدخال 6 رموز'
                            ]" required />
							</v-form>
							<v-card-actions class="justify-center" style="gap:10px">
								<v-chip label class="white--text" color="blue darken-3" @click.stop="login">
									<v-icon class="ml-1">mdi-login</v-icon> تسجيل دخول
								</v-chip>
								<!-- <v-chip label class="white--text" color="blue darken-3" @click.stop="login">
									<v-icon class="ml-1">mdi-login</v-icon> Register
								</v-chip> -->
								<v-btn text label @click.stop="resetEmail">استعادة الرقم السري</v-btn>
							</v-card-actions>
						</v-card-text>

					</v-card>
				</div>

			</v-col>
		</v-row>

		<v-row class="justify-center">

			<v-col cols="6" sm="4" md="3">
				<v-card height="120" style="gap:20px" class="info white--text pa-2 d-flex flex-column justify-center align-center">
					<v-icon color="yellow" large>mdi-school</v-icon>
					<span class="text-center">Master Registration</span>
				</v-card>
			</v-col>

			<v-col cols="6" sm="4" md="3">
				<v-card height="120" style="gap:20px" class="info white--text pa-2 d-flex flex-column justify-center align-center">
					<v-icon color="yellow" large>mdi-school</v-icon>
					<span>Master </span>
				</v-card>
			</v-col>
			<v-col cols="6" sm="4" md="3">
				<v-card height="120" style="gap:20px" class="info white--text pa-2 d-flex flex-column justify-center align-center">
					<v-icon color="yellow" large>mdi-school</v-icon>
					<span>Master Registration</span>
				</v-card>
			</v-col>
			<v-col cols="6" sm="4" md="3">
				<v-card height="120" style="gap:20px" class="info white--text pa-2 d-flex flex-column justify-center align-center">
					<v-icon color="yellow" large>mdi-school</v-icon>
					<span>Master Registration</span>
				</v-card>
			</v-col>
			<v-col cols="6" sm="4" md="3">
				<v-card height="120" style="gap:20px" class="info white--text pa-2 d-flex flex-column justify-center align-center">
					<v-icon color="yellow" large>mdi-school</v-icon>
					<span>Master Registration</span>
				</v-card>
			</v-col>
			<v-col cols="6" sm="4" md="3">
				<v-card height="120" style="gap:20px" class="info white--text pa-2 d-flex flex-column justify-center align-center">
					<v-icon color="yellow" large>mdi-school</v-icon>
					<span>Master Registration</span>
				</v-card>
			</v-col>
			<v-col cols="6" sm="4" md="3">
				<v-card height="120" style="gap:20px" class="info white--text pa-2 d-flex flex-column justify-center align-center">
					<v-icon color="yellow" large>mdi-school</v-icon>
					<span>Master Registration</span>
				</v-card>
			</v-col>
			<v-col cols="6" sm="4" md="3">
				<v-card height="120" style="gap:20px" class="info white--text pa-2 d-flex flex-column justify-center align-center">
					<v-icon color="yellow" large>mdi-school</v-icon>
					<span>Master Registration</span>
				</v-card>
			</v-col>
		</v-row>

		<d-dialog v-model="show_reset_password" title="Reset password" @save="SendResetCode" width="400px">
			<v-text-field prepend-icon="mdi-email" type="text" v-model="reset_email" focusable label="Email" :rules="[ v => !!v || 'E-mail is required',v => /.+@.+/.test(v) || 'E-mail must be valid']" required />
		</d-dialog>
	</div>
</template>

<script>
	import { get } from "vuex-pathify";
	export default {
		data() {
			return {
				alerts: [],
				publications: [],
				show_reset_password: false,
				test: false,
				reset: false,
				email: null,
				password: null,
				has_error: false,
				rcode: "",
				newcode: "",
				reset_email: "",
			};
		},
		computed: {
			...get(["_settings", 'general_settings']),
		},
		created() {
			//this.fetchRecentAnnoincements();
			//this.fetchRecentPubication();
		},
		methods: {
			fetchRecentAnnoincements() {
				axios.get("alerts?recent=true").then((res) => (this.alerts = res.data));
			},
			fetchRecentPubication() {
				axios
					.get("publication?recent=true")
					.then((res) => (this.publications = res.data));
			},
			login() {
				// get the redirect object
				if (!this.$refs.form.validate()) return;
				// var redirect = this.$auth.redirect()
				var app = this;

				//	this.axios.get(window.location.protocol + "//" + window.location.hostname + '/sanctum/csrf-cookie').then(res => {
				this.$auth
					.login({
						data: {
							email: this.email,
							password: this.password,
							//  useCredentails: true
						},
						rememberMe: true,
						staySignedIn: true,
						fetchUser: true,
						redirect: {
							path: "/user-dashboard/personal-details",
						},
					})
					.then(
						() => { },
						() => {
							this.has_error = true;
						}
					);
				//	})
			},

			resetEmail() {
				this.reset_email = this.email;
				this.show_reset_password = true;
			},

			SendResetCode() {
				// get the redirect object

				this.axios
					.post("/auth/send-reset-code", {
						email: this.reset_email,
					})
					.then((res) => {
						alert(res.data);
					})
					.catch((err) => {
						alert(err);
					});
			},
		},
	};
</script>

<style lang="scss" scoped>
	.bg {
		background-image: url("/storage/imgs/bg16.png");
		background-repeat: repeat;
	}
</style>
