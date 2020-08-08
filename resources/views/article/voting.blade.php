@php
    $user_vote = $object->getUserVote();
@endphp

<div class="vote-container">

    <span class="votes-up">
        <i class="{{($user_vote>0)?'fas':'far'}} fa-thumbs-up thumb-icon @guest restrict @endguest" vote-action="up"></i>
        <span class="votes-count">{{$object->getVotesUp()}}</span>
    </span>

    <i class="fas fa-circle votes-separator"></i>

    <span class="votes-down">
        <span class="votes-count">{{$object->getVotesDown()}}</span>
        <i class="{{($user_vote<0)?'fas':'far'}} fa-thumbs-down thumb-icon @guest restrict @endguest" vote-action="down"></i>
    </span>

</div>
