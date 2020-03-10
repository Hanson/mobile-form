<div id="mobile-code-field" class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div class="input-group">

            @if ($prepend)
                <span class="input-group-addon">{!! $prepend !!}</span>
            @endif

            <input {!! $attributes !!} v-model="mobile" />

            @if ($append)
                <span class="input-group-addon clearfix">{!! $append !!}</span>
            @endif

            <button v-bind:disabled="count_down != 60" type="button" class="btn btn-light" style="margin-left: 20px;" v-on:click="sendCode">@{{ code_text }}</button>

        </div>

        @include('admin::form.help-block')

    </div>
</div>


<script src="https://cdn.bootcss.com/vue/2.6.10/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.19.0/axios.min.js"></script>
<script>
  new Vue({
    el: '#mobile-code-field',
    data: {
      mobile: '1',
      count_down: 60,
      code_text: '发送验证码'
    },
    methods: {
      sendCode: function () {
        console.log(this.mobile)
        if(!(/^1[3456789]\d{9}$/.test(this.mobile))){
          alert("手机号码有误，请重填");
          return false;
        }
        this.countdown()
        axios.post('/admin/info/send', {mobile: this.mobile})
      },
      countdown: function() {
        var that = this;
        if(that.count_down == 0) {
          this.code_text = '发送验证码'
          that.count_down = 60;
          return false;
        } else {
          this.code_text = this.count_down + ' 秒后发送验证码'
          that.count_down--;
        }
        setTimeout(function() {
          that.countdown();
        }, 1000);
      },
    }
  })
</script>
