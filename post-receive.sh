# You have to put this file in the folder hooks of your bare git repository, don't forget allow the excecution of this file (chmod +x post-receive)
# The folder where you want to put your project
TARGET="/home/ubuntu/www/project"

# The folder of the git bare repository
GIT_DIR="/home/ubuntu/project.git"

BRANCH="master"

while read oldrev newrev ref
do
        # only checking out the master (or whatever branch you would like to deploy)
        if [ "$ref" = "refs/heads/$BRANCH" ];
        then
                echo "Ref $ref received. Deploying ${BRANCH} branch to production..."
                git --work-tree=$TARGET --git-dir=$GIT_DIR checkout -f $BRANCH
                # run the command new-push of the project makefile, adapt the command for your project
                make new-push -C $TARGET
        else
                echo "Ref $ref received. Doing nothing: only the ${BRANCH} branch may be deployed on this server."
        fi
done
