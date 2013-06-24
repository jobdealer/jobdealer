<div class="hero-unit">
    <h1>{$this->translate('List of node')}</h1>
    <p>
        <a href="{$this->url('node', ['action'=>'add'])}" class="btn btn-success">Add new node</a>
    </p>
    <table class="table table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>{$this->translate('Nodename')}</th>
            <th>{$this->translate('Ip Address')}</th>
            <th>{$this->translate('Description')}</th>
            <th>{$this->translate('Lastseen')}</th>
            <th>{$this->translate('Operation')}</th>
        </tr>
        {foreach $nodes as $node}
            <tr>
                <td>{$this->escapeHtml($node->id)}</td>
                <td>{$this->escapeHtml($node->nodename)}</td>
                <td>{$this->escapeHtml($node->ipaddr)}</td>
                <td>{$this->escapeHtml($node->description)}</td>
                <td>{$this->escapeHtml($node->lastseen)}</td>
                <td>
                    <a href="{$this->url('node', ['action'=>'edit', 'id' => $node->id])}">
                        <span class="icon page-white-edit" title="{$this->translate('Edit')}"/>
                    </a>
                    <a href="{$this->url('node', ['action'=>'delete', 'id' => $node->id])}">
                        <span class="icon cross" title="{$this->translate('Delete')}"/>
                    </a>
                </td>
            </tr>
            {foreachelse}
            <tr class="info"><td colspan="6" class="text-center">{$this->translate("Cant't find any node !")}</td></tr>
        {/foreach}
    </table>
</div>