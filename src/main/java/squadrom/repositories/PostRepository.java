package squadrom.repositories;

import org.springframework.data.repository.CrudRepository;

import squadrom.models.Post;

public interface PostRepository extends CrudRepository<Post, Long> {


}