<!-- account/dashboard.blade.php -->

@extends('account.body.app')

@section('content')
<!-- resources/views/layouts/app.blade.php -->

<style>
  .chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
  }

  .chat li .chat-body p {
    margin: 0;
    color: #777777;
  }

  .panel-body {
    overflow-y: scroll;
    height: 350px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
  }
</style>

<div>
	 <div class="container">
		<h3>Pusher</h3>
		<div class="container">
        <template>
            <ul class="chat">
                <li class="left clearfix" v-for="message in messages">
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">
                                {{ message.user.name }}
                            </strong>
                        </div>
                        <p>
                            {{ message.message }}
                        </p>
                    </div>
                </li>
            </ul>
        </template>

        <script>
          export default {
            props: ['messages']
          };
        </script>
		</div>
	</div>
</div>
@endsection