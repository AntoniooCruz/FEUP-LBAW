<div class="comment my-2">
                  <div class="row">
                    <?php dd($comment->id_author) ?>
                      @if (file_exists(public_path('img/users/originals/' . strval($comment->id_author) . '.png')) )
                      <img src={{"../img/users/originals/" . strval($comment->id_author) . ".png"}} class="roundRadius" alt="Card image cap">
                    @else
                      <img  src="../img/user.jpg" class="roundRadius" alt="Card image cap">
                    @endif
                    <div class="col-10 align-self-center commentText roundRadius px-4 ml-1">
                      <div>{{$comment->text}}.</div>
                    </div>
                  </div>
                </div>