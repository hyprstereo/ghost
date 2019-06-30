<template>
    <div class="container">
        <div class="box">
            <a-form
                id="components-form-demo-normal-login"
                :form="form"
                class="login-form"
                @submit="handleSubmit"
            >
                <a-form-item>
                <a-input
                    v-decorator="[
                    'userName',
                    { rules: [{ required: true, message: 'Please input your username!' }] }
                    ]"
                    placeholder="Username"
                >
                    <a-icon
                    slot="prefix"
                    type="user"
                    style="color: rgba(0,0,0,.25)"
                    />
                </a-input>
                </a-form-item>
                <a-form-item>
                <a-input
                    v-decorator="[
                    'password',
                    { rules: [{ required: true, message: 'Please input your Password!' }] }
                    ]"
                    type="password"
                    placeholder="Password"
                >
                    <a-icon
                    slot="prefix"
                    type="lock"
                    style="color: rgba(0,0,0,.25)"
                    />
                </a-input>
                </a-form-item>
                <a-form-item>
                <a-checkbox
                    v-decorator="[
                    'remember',
                    {
                        valuePropName: 'checked',
                        initialValue: true,
                    }
                    ]"
                >
                    Remember me
                </a-checkbox>
                <a
                    class="login-form-forgot"
                    href=""
                >
                    Forgot password
                </a>
                <a-button
                    type="primary"
                    html-type="submit"
                    class="login-form-button"
                >
                    Log in
                </a-button>
                Or <a href="">
                    register now!
                </a>
                </a-form-item>
            </a-form>
        </div>
    </div>
</template>
<script>

export default {
    beforeCreate() {
        this.form = this.$form.createForm (this);
    },
    methods: {
        handleSubmit (e) {
            console.log('submit');
        }
    }
}
</script>
<style>
.container {
    text-align: center;
}
.box {
    position: relative;
    display:inline-block;
    text-align: left;
    left:0;
    right: 0;
    width: 50%;
    min-width: 300px;
    height: 50px;
}
</style>