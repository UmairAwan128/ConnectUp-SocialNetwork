<div class="conversation-box">
    
        <div class="conversation-header">
            <div class="user-message-details">
                <div class="user-message-img">
                    <img src="/storage/users_profiles/{{ $userToChat->profilePic }}" class="img-responsive img-circle" alt="">
                </div>
                <div class="user-message-info">
                    <h4>{{ $userToChat->f_name }} {{ $userToChat->l_name }}</h4>
                    <p>{{ $userToChat->email }}</p>
                </div><!--/ user-message-info -->
            </div><!--/ user-message-details -->
            <a href="#" title=""><i class="fa fa-ellipsis-v"></i></a>
        </div><!--/ conversation-header -->

        <div class="conversation-container" id="scroll_messages">
       
            @if(count($Messages) > 0)
          
              @foreach($Messages as $message)

                    @if ($message->user_to == $userToChat->id
                        AND $message->user_id == Auth::user()->id) 

                        <div class='convo-box pull-right'>
                            <div class='convo-area'>
                                <div class='convo-message'>
                                   <p>{{ $message->content }}</p>
                                </div><!--/ convo-message-->
                                <span>{{ $message->created_at }}</span>
                            </div><!--/ convo-area -->
                            <div class='convo-img'>
                                <img src='/storage/users_profiles/{{ Auth::user()->profilePic }}' alt='' class='img-responsive img-circle'>
                            </div><!--/ convo-img -->
                        </div><!--/ convo-box -->
                    @elseif ($message->user_to == Auth::user()->id 
                              AND $message->user_id == $userToChat->id) 
                        <div class='convo-box convo-left'>
                                <div class='convo-area convo-left'>
                                   <div class='convo-message'>
                                   <p>{{ $message->content }}</p>
                                   </div><!--/ convo-message-->
                                   <span>{{ $message->created_at }}</span>
                                </div><!--/ convo-area -->
                                <div class='convo-img'>
                                   <img src='/storage/users_profiles/{{ $userToChat->profilePic }}' alt='' class='img-responsive img-circle'>
                                </div><!--/ convo-img -->
                        </div><!--/ convo-box -->           
                        @else
                            <p>Error occured</p>
                        @endif
          
                @endforeach
                  
          @else
              <p>No Conversation found</p>
          @endif
                       
        </div><!--/ conversation-container -->

            <form action="" method="post" id="createMessage_form"> 
                <div class="type_messages">  
                    <div class="input-field">
                        <textarea placeholder="Enter your msg" required="required" name="msgBody" id="message_textarea"></textarea>
                        <input type="hidden" id="btn-msg" name="user_to" value="{{ $userToChat->id }}" />    
                        <input type="submit" id="btn-msg" name="send_msg" value="Send" />     
                    </div><!--/ input-field -->
                </div><!--/ type_messages -->
            </form>

        </div><!--main-conversation-box end-->