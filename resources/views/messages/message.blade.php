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
      AND $message->user_id == $userToChat->id) {
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
