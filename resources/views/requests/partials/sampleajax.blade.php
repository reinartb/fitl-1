<?php
if( ! $items->isEmpty()  ) { 
    $count = 1;
    $outputhead = '';
    $outputbody = '';  
    $outputtail ='';

    $outputhead .= '<div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Show</th>
                                </tr>
                            </thead>
                            <tbody>
                    ';
              
    foreach ($items as $item) {
        $show = route('items.show', $item->id);
        $outputbody .=  ' 
                            <tr> 
    	                        <td>'.$count++.'</td>
    	                        <td>'.$item->name.'</td>
                                <td>'.$item->created_at.'</td>
                                <td><a href="'.$show.'" target="_blank" title="SHOW" ><span class="glyphicon glyphicon-list"></span></a></td>
                            </tr> 
                        ';
    }  

    $outputtail .= ' 
                </tbody>
            </table>
        </div>';
     
    echo $outputhead; 
    echo $outputbody; 
    echo $outputtail; 
} else {  
    echo 'Item Not Found';  
}

?>  