<li>
    {{$node->name}}
</li>
<ul class="ml-4">
    @each('nested.category',$node->children,'node','nested.no-category')
</ul>
